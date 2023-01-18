import { useState, useEffect } from "react";
import axios from "axios";
import Router from 'next/router'
import Subscriptionhistorydetail from "./sections/Subscriptionhistorydetail";

const SubcriptionHistory = () => {
  const [subscriptionData, setSubscriptionData] = useState([]);

  const getOrderDetail = (orderId) => {
    Router.push("subscriptionHistory/" + orderId);
  }

  const add_data = {
    "account_id": 2
  }

  const getSubscription = async () => {
    try {
      const response = await axios({
        method: "POST",
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/get-subscription-order-web-bo.php",
        data: add_data
      });
      console.log(response, 'hulu');
      setSubscriptionData(response.data);
    } catch (err) {
      console.log(err);
    }
  };
  useEffect(() => {
    getSubscription();
  }, []);
  return (
    <div>
      <div className="profile_section ">
        <div className="container-fluid p_50">
          <div className="row">
            <div className="col-lg-12">
              <div className="global_header text-center history_header py-lg-5">
                <h4 className="global_herder_title">Subscription History</h4>
              </div>
              {/* <div className="searh_box_header">
                <div className="row justify-content-center">
                  <div className="col-lg-7">
                    <div className="searh_box_header_input position-relative mt-5 mt-lg-0">
                      <div className="search_box_header_icon">
                        <img
                          src="https://i.ibb.co/ZLyZqB4/search-6-1.png"
                          alt=""
                        />
                      </div>
                      <input
                        type="text"
                        className="input_seach_history form-control"
                        placeholder="Search for answers, topics..."
                      />
                    </div>
                  </div>
                </div>
              </div> */}
            </div>
            <div className="col-lg-12">
              <div className="row justify-content-center">
                <div className="col-lg-6">
                  <div className="button_active_arae mb-5">
                    <button className="common_btn_btn active_btn">
                      Active
                    </button>
                    <button className="common_btn_btn cancel_btn">
                      Cancelled
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <div className="colg-lg-12">
              <div className="row">
                {subscriptionData && subscriptionData.length > 0 ? subscriptionData.map((item) => {
                  return (
                    <div style={{cursor:'pointer'}} onClick={() => getOrderDetail(item.order_id)} key={item.order_id} className="col-lg-6">
                      <div className="history_card_area_box _history_box_ mb-5">
                        <div className="history_row_item d-flex align-items-center">
                          <div className="history_title_card_left w-50">
                            <h4>Order Id :</h4>
                          </div>
                          <div className="history_title_card_right w-50">
                            <h4>{item.new_order_id} </h4>
                          </div>
                        </div>
                        <div className="history_row_item d-flex align-items-center">
                          <div className="history_title_card_left w-50">
                            <h4>Date :</h4>
                          </div>
                          <div className="history_title_card_right w-50">
                            <h4>{item.date} </h4>
                          </div>
                        </div>
                        <div className="history_row_item d-flex align-items-center">
                          <div className="history_title_card_left w-50">
                            <h4>Amount :</h4>
                          </div>
                          <div className="history_title_card_right w-50">
                            <h4>{item.amount} </h4>
                          </div>
                        </div>
                        <div className="history_row_item d-flex align-items-center">
                          <div className="history_title_card_left w-50">
                            <h4>Status :</h4>
                          </div>
                          <div className="history_title_card_right w-50">
                            <h4>{item.status}</h4>
                          </div>
                        </div>
                      </div>
                    </div>
                  )
                }) : ""}
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default SubcriptionHistory;
