import Link from "next/link";
import { useState, useEffect } from "react";
import { cashfreeSandbox } from 'cashfree-dropjs';
//use import { cashfreeProd } from 'cashfree-dropjs';
import axios from "axios";
import Router from 'next/router';

const NormalCheckout = () => {
  const [totalData, setTotalData] = useState({});
  const [walletData, setWalletData] = useState();

  const [showpayData, setShowpayData] = useState(0);
  const [useridData, setUseridData] = useState();
  const [addressidData, setAddressidData] = useState();
  const [couponData, setCouponData] = useState(0);



  
const payOnline = async(isWall) => {
  setShowpayData(1);
  const useEmail = localStorage.getItem('email');
  const useId = localStorage.getItem('user_id');
  const usePhone = localStorage.getItem('phone');
  const isWallet = isWall;


  const send_data = {
    "order_id": Math.floor(Date.now() + Math.random()),
    "amount" : isWall==1?(totalData.grand_total-walletData-couponData) : totalData.grand_total-couponData,
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
              payNormal(isWallet, data.transaction.transactionId);
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



  const getBundle = async () => {
    const useNme = localStorage.getItem('name');
    const useId = localStorage.getItem('user_id');
    const addId = localStorage.getItem('addressId');

    const couponDiscount = localStorage.getItem('coupon_discount');
    if(couponDiscount!=null){
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
    } catch (err) {
      console.log(err);
    }
  };

  const getWalletAmount = async () => {
    const useId = localStorage.getItem('user_id');
    const send_data = {
      "user_id": useId
    }
    try {
      const response = await axios({
        method: "POST",
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/get-wallet-amount-web.php",
        data: send_data
      });
      // console.log(response, 'hulu');
      // return;
      setWalletData(response.data.wallet_balance);
    } catch (err) {
      console.log(err);
    }
  };

  const payNormal = async (iswallet, tran_id) => {
   if(iswallet == 0){
    const send_data = {
      "cashfree_payment_id": tran_id,
      "total_cart_value": totalData.grand_total-couponData,
      "account_id": useridData,
      "subscription": 0,
      "subscription_month": 0,
      "address_id": addressidData,
      "is_wallet": iswallet,
      "is_coupon": 0,
      "coupon_id": 0,
      "month_amount_value": 0
    }
    try {
      const response = await axios({
        method: "POST",
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/checkout-with-payment-web-bo.php",
        data: send_data
      });
      console.log(response.data, "sanvi");
      if(response.data.response == '1'){
        localStorage.removeItem('coupon_discount');
        Router.push('thanksPage');
      }
    } catch (err) {
      console.log(err);
    }
   }

   if(iswallet == 1){
    const send_data = {
      "cashfree_payment_id": tran_id,
      "total_cart_value": totalData.grand_total-couponData,
      "account_id": useridData,
      "subscription": 0,
      "subscription_month": 0,
      "address_id": addressidData,
      "is_wallet": iswallet,
      "is_coupon": 0,
      "coupon_id": 0,
      "month_amount_value": 0
    }
    const wallet_data = {
      "user_id": useridData,
      "tran_id": tran_id,
      "amount": walletData>totalData.grand_total-couponData? walletData: (totalData.grand_total-couponData-walletData)
    }
    //  console.log(wallet_data,'niks');
    // return;
    try {

      const response = await axios({
        method: "POST",
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/add-amount-wallet-web.php",
        data: wallet_data
      });
      // console.log(response, 'niks');
      // return;
      if(response.data.response == 1){
        const response1 = await axios({
          method: "POST",
          url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/checkout-with-payment-web-bo.php",
          data: send_data
        });
        // console.log(response1.data, "niks");
        if(response1.data.response == '1'){
          localStorage.removeItem('coupon_discount');
          Router.push('thanksPage');
        }
      }
    } catch (err) {
      console.log(err);
    }
   }

  };

  useEffect(() => {
    getBundle();
    getWalletAmount();
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

        </div>
        
        : 
        <div className="bundle_sub_section">
        <div className="container-fluid ">
          <div className="row">
            <div className="col-lg-12">
              <div className="bundle_wrap">
                <div className="bundle_heading d-flex justify-content-between">
                  <div className="left">
                    <h1>One Time Checkout</h1>
                    {/* <p>
                      Select Months & Preview Wallet. <br />
                      You can cancel or pause you subscription anytime!
                    </p> */}
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
            {/* <div className="col-lg-7">
              <div className="bundle_wrap mb-3">
                <div className="monthly_arae">
                  <button className="subscription_btn">
                    Monthly Subscribe Benefits Includes
                  </button>
                  <div className="month_content">
                    <div>
                      <p>
                        {" "}
                        <img src="./image/dot.png" alt="" /> Get 5% off on
                        every shipment
                      </p>
                      <p>
                        <img src="./image/dot.png" alt="" /> Free Shipping
                        Always
                      </p>
                      <p>
                        <img src="./image/dot.png" alt="" /> Surprise Benefits
                        with every 3rd Shipment
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div> */}
            <div className="col-lg-12">
              <div className="check_out_price_area">
                <div className="bundle_sub_total_item">
                  <div className="sub_discount_title">
                    <h3>Total</h3>
                    <div className="discount_price">
                      <span> ₹ {totalData && totalData != "" ? totalData.grand_total : ""}.00 </span>
                    </div>
                    <div className="offer_price">
                      <span>₹ {totalData && totalData != "" ? totalData.grand_total - couponData : ""}.00</span>
                      <div className="offer_badge">
                            <span>₹ {couponData}off</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div className="check_out_wallet">
                  
                </div>
              </div>
            </div>
            <div className="row">
              <div className="col-md-4">
                                {walletData > totalData.grand_total-couponData ?
                                <div className="check_out_w_des">
                                <button className="mb-3 mb-md-0 mb-lg-0" style={{
                                    backgroundColor: "#09A42B", borderRadius: '10px',
                                    margin: '23px auto',
                                    padding: '7px 14px',
                                    color: '#fff',
                                    fontWeight:'bold',
                                    width: '60%'
                                }}
                                onClick={() => payOnline(1)}
                                >Proceed with Wallet</button>
                            </div>
                                 :
                                 <div className="check_out_w_des">
                                    <button className="mb-3 mb-md-0 mb-lg-0" style={{
                                        backgroundColor: "#09A42B", borderRadius: '10px',
                                        margin: '23px auto',
                                        padding: '7px 14px',
                                        color: '#fff',
                                        fontWeight:'bold',
                                        width: '60%'
                                    }}
                                    onClick={() => payOnline(1)}
                                    >Add ₹ {totalData.grand_total-couponData - walletData} more to wallet & <span style={{float:'left', paddingLeft:'5px'}}>Proceed</span></button>
                                </div>
                                 }
                                <h6>Available wallet balance : ₹ {walletData}</h6>
              </div>
                            <div className="col-md-4">
                                <div className="check_out_w_des">
                                    <button className="mb-3 mb-md-0 mb-lg-0" style={{
                                        backgroundColor: "#F6F949 ", borderRadius: '10px',
                                        margin: '23px auto',
                                        padding: '14px 32px',
                                        color: '#000',
                                        fontWeight: 'bold'
                                    }}
                                    onClick={() => payOnline(0)}
                                    >Pay Online</button>
                                </div>
                                
                            </div>
                            <div className="colo-md-4"></div>
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

export default NormalCheckout;
