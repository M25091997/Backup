import { useState, useEffect } from "react";
import { cashfreeSandbox } from 'cashfree-dropjs';
import Form from 'react-bootstrap/Form';
import Router from 'next/router';

import axios from "axios";
import Link from "next/link";
const FinalCheckout = () => {
  const [totalData, setTotalData] = useState({});
  const [showpayData, setShowpayData] = useState(0);
  // const [selectdmonthData, setSelectdmonthData] = useState(0);
  const [wallettotalData, setWalletTotalData] = useState();
  const [useridData, setUseridData] = useState();
  const [addressidData, setAddressidData] = useState();
  const [benifitData, setBenifitData] = useState([]);
  const [couponData, setCouponData] = useState(0);




  const handleMonthSelect = (mon) => {
    const newTotal = mon * (totalData.grand_total-couponData);
    setWalletTotalData(newTotal);
  }


  
const payOnline = async() => {
  setShowpayData(1);
  const useEmail = localStorage.getItem('email');
  const useId = localStorage.getItem('user_id');
  const usePhone = localStorage.getItem('phone');


  const send_data = {
    "order_id": Math.floor(Date.now() + Math.random()),
    "amount" : wallettotalData,
    "user_id" : useId,
    "user_email" : useEmail,
    "user_phone" : usePhone
  }
  try {
    const response = await axios({
      method: "POST",
      url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/cash-free-web.php",
      data: send_data
    });
    // console.log(response, 'hulu');
    // return;
    if(response.data.order_token != '' || response.data.order_token != null){
      let parent = document.getElementById('drop_in_container');
        parent.innerHTML = '';
        let testCashfree = new cashfreeSandbox.Cashfree();
      //let prodCashfree = new cashfreeProd.Cashfree();

        console.log('before Initialisation');
        testCashfree.initialiseDropin(parent, {
          orderToken : response.data.order_token,
          onSuccess: (data) => {
            if (data.order && data.order.status == "PAID") {
              console.log(data);
              //order is paid
              //verify order status by making an API call to your server

              payNormal(data.transaction.transactionId);

              // using data.order.orderId
            } else {
              console.log(data);
            }
              
          },
          onFailure: () => {alert('fail')},
          components: [
            "order-details",
            "card",
            "netbanking",
            "app",
            "upi",
            "paylater",
            "credicardemi",
            "cardlessemi",
        ],
          style: {
            //to be replaced by the desired values
            "backgroundColor": "#ffffff",
            "color": "#11385b",
            "fontFamily": "Lato",
            "fontSize": "14px",
            "errorColor": "#ff0000",
            "theme": "light", //(or dark)
        },
      });
        console.log('after Initialisation');

    }else{
      alert('Something went wrong');
    }
  } catch (err) {
    console.log(err);
  }
 
      //   let parent = document.getElementById('drop_in_container');
      //   parent.innerHTML = '';
      //   let testCashfree = new cashfreeSandbox.Cashfree();
      // //let prodCashfree = new cashfreeProd.Cashfree();

      //   console.log('before Initialisation');
      //   testCashfree.initialiseDropin(parent, {
      //     orderToken : response.data.cftoken,
      //     onSuccess: () => {alert('success')},
      //     onFailure: () => {alert('fail')},
      //     components: [
      //       "order-details",
      //       "card",
      //       "netbanking",
      //       "app",
      //       "upi",
      //       "paylater",
      //       "credicardemi",
      //       "cardlessemi",
      //   ],
      //     style: {
      //       //to be replaced by the desired values
      //       "backgroundColor": "#ffffff",
      //       "color": "#11385b",
      //       "fontFamily": "Lato",
      //       "fontSize": "14px",
      //       "errorColor": "#ff0000",
      //       "theme": "light", //(or dark)
      //   },
      // });
      //   console.log('after Initialisation');


};

const payNormal = async (tran_id) => {
  const send_data = {
    "cashfree_payment_id": tran_id,
    "total_cart_value": totalData.grand_subs_total-couponData,
    "account_id": useridData,
    "subscription": 1,
    "subscription_month": 0,
    "address_id": addressidData,
    "is_wallet": 1,
    "is_coupon": 0,
    "coupon_id": 0,
    "month_amount_value": 0
  }

  const wallet_data = {
    "user_id": useridData,
    "tran_id": tran_id,
    "amount": wallettotalData
  }

  try {

    const response = await axios({
      method: "POST",
      url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/add-amount-wallet-web.php",
      data: wallet_data
    });
    // console.log(response, 'niks');
    // return;
    if (response.data.response == 1) {
      const response1 = await axios({
        method: "POST",
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/checkout-with-payment-web-bo.php",
        data: send_data
      });
      // console.log(response1.data, "niks");
      if (response1.data.response == '1') {
        localStorage.removeItem('coupon_discount');
        Router.push('thanksPage');
      }
    }
  } catch (err) {
    console.log(err);
  }

  // try {
  //   const response = await axios({
  //     method: "POST",
  //     url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/checkout-with-payment-web-bo.php",
  //     data: send_data
  //   });
  //   console.log(response.data, "sanvi");
  //   if(response.data.response == '1'){
  //     Router.push('thanksPage');
  //   }
  // } catch (err) {
  //   console.log(err);
  // }
};

  const getBundle = async () => {
    const useNme = localStorage.getItem('name');
    const useId = localStorage.getItem('user_id');
    const addId = localStorage.getItem('addressId');
    const couponDiscount = localStorage.getItem('coupon_discount');
    if (couponDiscount != null) {
      setCouponData(couponDiscount);
    }

    setUseridData(useId);
    setAddressidData(addId);
    if (useNme == null || useId == null) {
      Router.push('../login');
      return;
    }
    const send_data = {
      "user_id": useId
    }
    try {
      const response = await axios({
        method: "POST",
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/get-checkout-total-web-bo.php",
        data: send_data
      });
      // console.log(response, 'hulu');
      setTotalData(response.data.total);
      setWalletTotalData((response.data.total.grand_subs_total - couponData) * 2);
    } catch (err) {
      console.log(err);
    }
  };

  const getSubscriptionBenifit = async() => {

    try {
      const response = await axios({
        method: "GET",
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/get-subscription-benefit-bo.php"
      });
      // console.log(response, 'hulu');
      setBenifitData(response.data);
      
    } catch (err) {
      console.log(err);
    }
  }

  useEffect(() => {
    getBundle();
    getSubscriptionBenifit();
  }, []);

  return (
    <div>
      <div className="container">
        {showpayData ?  
         <div className="row">  
            <div className="col-md-4"></div>
            <div className="col-md-4">
          <div
            className="dropin-parent"
            id="drop_in_container"
            style={{ height: '500px' }}
          >
          </div> 
          </div>
          <div className="col-md-4"></div>

        </div> : 
        <div className="bundle_sub_section">
        <div className="container-fluid ">
          <div className="row">
            <div className="col-lg-12">
              <div className="bundle_wrap">
                <div className="bundle_heading d-flex justify-content-between">
                  <div className="left">
                    <h1>Subscribe & Checkout</h1>
                    <p>
                      Select Months & Preview Wallet. <br />
                      You can cancel or pause you subscription anytime!
                    </p>
                  </div>

                  <div className="right">
                    <Link href="/bundlePreview">
                      <a className="procceed-button btn m-3 py-2">
                        Proceed to Bundle Preview
                        <img
                          className="m-2"
                          src="https://i.ibb.co/HTLfjs1/Vector-2.png"
                          alt="Picture of the author"
                        />
                      </a>
                    </Link>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div className="row">
            <div className="col-lg-7">
              <div className="bundle_wrap mb-3">
                <div className="monthly_arae">
                  <button className="subscription_btn">
                    Monthly Subscribe Benefits Includes
                  </button>
                  <div className="month_content">
                    <div>
                      {benifitData && benifitData.length > 0 ? benifitData.map((item) => {
                          return (
                            <p key={item.id} style={{fontSize:'18px', marginBottom:'-30px'}}>{item.name}</p>
                          )
                      }) : ""}
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div className="col-lg-7">
              <div className="check_out_price_area">
                <div className="bundle_sub_total_item">
                  <div className="sub_discount_title">
                    <h3>Total</h3>
                    <div className="discount_price">
                      <span> ₹ {totalData && totalData != "" ? totalData.grand_total-couponData : ""}.00 </span>
                    </div>
                    <div className="offer_price">
                      <span>₹ {totalData && totalData != "" ? totalData.grand_subs_total-couponData : ""}.00</span>
                      <div className="offer_badge">
                        <span>5%off</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div className="check_out_wallet">
                  <div className="add_price select_price">
                    Add <span>₹ {totalData && totalData != "" ? totalData.grand_subs_total-couponData : ""}.00 </span> x
                    {/* <button href="/">
                      {" "}
                      <img src="./image/₹.png" alt="" /> 2 Months / Times
                      <img src="./image/Vector.png" alt="" />
                    </button> */}
                    <Form.Select aria-label="Default select example" onChange={(e) => handleMonthSelect(e.target.value)}>
                      {/* <option value="1">Select Months/Times</option> */}
                      <option value="2">02 Months/Times</option>
                      <option value="3">03 Months/Times</option>
                      <option value="4">04 Months/Times</option>
                      <option value="5">05 Months/Times</option>
                      <option value="6">06 Months/Times</option>
                      <option value="7">07 Months/Times</option>
                      <option value="8">08 Months/Times</option>
                      <option value="9">09 Months/Times</option>
                      <option value="10">10 Months/Times</option>
                      <option value="11">11 Months/Times</option>
                      <option value="12">12 Months/Times</option>

                    </Form.Select>
                  </div>
                  <div style={{cursor:'pointer'}} className="processed_checkout" onClick={() => payOnline()}>
                    <h3>
                      Add <span>₹ {wallettotalData} </span> to <br /> Wallet & Proceed{" "}
                      <img src="./image/check_arro.png" alt="" />{" "}
                    </h3>
                  </div>
                </div>
              </div>

              <div className="check_out_w_des">
                <p>
                  Bundle amount will be <br />
                  auto debited on 7th of every
                  <br />
                  month from your wallet.
                </p>
              </div>
            </div>
          </div>
        </div>
        <div className="bundle_bg_shape">
          <div className="bundle_bg_warp"></div>
        </div>
      </div>
        }
        
      </div>
    </div>
  );
};

export default FinalCheckout;
