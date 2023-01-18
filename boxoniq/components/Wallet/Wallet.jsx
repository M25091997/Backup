import Link from "next/link";
import { useState, useEffect } from "react";
import { cashfreeSandbox } from 'cashfree-dropjs';
//use import { cashfreeProd } from 'cashfree-dropjs';
import axios from "axios";
import Router from 'next/router';
const Wallet = () => {
  const [wallethistoryData, setWallethistoryData] = useState([]);
  const [walletamountData, setWalletamountData] = useState(0);
  const [addAmount, setAddAmount] = useState();


  const [showpayData, setShowpayData] = useState(0);

  const payOnline = async() => {
    setShowpayData(1);
    const useEmail = localStorage.getItem('email');
    const useId = localStorage.getItem('user_id');
    const usePhone = localStorage.getItem('phone');

    const addAmountToWallet = async(userId,tranId,amount) => {

      const send_data = {
        "user_id": userId,
        "tran_id": tranId,
        "amount": amount
      }

      try {
        const response = await axios({
          method: "POST",
          url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/add-amount-wallet-web.php",
          data: send_data
        });
        console.log(response, 'hulu');
        // setShowpayData(0);
        location.reload();
        // if(showpayData == 0){
        //   getBundle();
        //   console.log(showpayData,'hi');
        // }
        // if (response.data.response == 1) {
        //   alert(response.data.msg);
        // }
      } catch (err) {
        console.log(err);
      }

    }
  
  
    const send_data = {
      "order_id": Math.floor(Date.now() + Math.random()),
      "amount": addAmount,
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

                addAmountToWallet(useId,data.transaction.transactionId,addAmount);

                // using data.order.orderId
              } else {
                console.log(data);
                //order is still active and payment has failed
              }
              // addAmountToWallet()
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
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/get-wallet-history-web.php",
        data: send_data
      });
      console.log(response.data, 'hulu');
      setWallethistoryData(response.data.wallet_history);
      setWalletamountData(response.data.wallet_balance);
      // setTotalData(response.data.total);
    } catch (err) {
      console.log(err);
    }
  };

  useEffect(() => {
    getBundle();
  }, []);

  return (
    <div>
      <div className="profile_section">
        <div className="container-fluid p_50">
        {showpayData === 1 ? 
            <div className="row">  
            <div className="col-md-4"></div>
              <div className="col-md-4" style={{ display: showpayData == 1 ? "block" : "none" }}>
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
          <div className="row">
            <div className="col-lg-12">
              <div className="global_header text-center history_header pt-lg-5">
                <h4 className="global_herder_title">Boxoniq Wallet</h4>
              </div>
            </div>
            <div className="col-lg-12">
              <div className="row">
                <div className="col-lg-5">
                  <div className="history_card_area_box wallet_card_box mb-5">
                    <h3 className="transactions_title">Wallet Balance</h3>
                    <div className="wallet_price mb-4">
                      <h4>₹ {walletamountData}</h4>
                    </div>
                    <div className="wallet_price">
                      <input
                        type="text"
                        className=" form-control wallet_input w-100"
                        placeholder="Enter Amount"
                          value={addAmount}
                          onChange={(e) => setAddAmount(e.target.value)}
                      />
                    </div>
                    <div className="walltet_buttons mt-5 mb-3">
                      <button onClick={() => payOnline()} className="btn btn_wallet w-100">
                        + Add To Wallet
                      </button>
                    </div>
                  </div>
                </div>

                <div className="col-lg-7 ">
                  <div className="history_calculation_sidebar pb-5">
                    <h3 className="transactions_title">Transactions</h3>

                    {wallethistoryData && wallethistoryData.length > 0 ? wallethistoryData.map((item) => {
                      return (
                          <div key={item.tran_id} className="history_product_box transactions_box mb-4">
                          <div className="d-flex align-items-center justify-content-between ">
                            <div className="transaction_des">
                              <h4>{item.msg}</h4>
                              <h4>Order</h4>
                              <h4>{item.created_on}</h4>
                            </div>
                            <div>
                              <h3 className="transactions_price" style={{color:item.type==1?"green":"red"}}>₹ {item.amount}</h3>
                            </div>
                          </div>
                        </div>
                      )
                    }): ""}

                  </div>
                </div>
              </div>
            </div>
          </div>
          }
        </div>
      </div>
    </div>
  );
};

export default Wallet;
