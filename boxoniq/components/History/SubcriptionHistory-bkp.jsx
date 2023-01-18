import Subscriptionhistorydetail from "./sections/Subscriptionhistorydetail";

const SubcriptionHistory = () => {
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
                <div className="col-lg-5">
                  <div className="history_card_area_box _history_box_ mb-5">
                    <div className="history_row_item d-flex align-items-center">
                      <div className="history_title_card_left w-50">
                        <h4>Order Id :</h4>
                      </div>
                      <div className="history_title_card_right w-50">
                        <h4>83474546784039156 </h4>
                      </div>
                    </div>
                    <div className="history_row_item d-flex align-items-center">
                      <div className="history_title_card_left w-50">
                        <h4>Date :</h4>
                      </div>
                      <div className="history_title_card_right w-50">
                        <h4>2022-05-23 </h4>
                      </div>
                    </div>
                    <div className="history_row_item d-flex align-items-center">
                      <div className="history_title_card_left w-50">
                        <h4>Amount :</h4>
                      </div>
                      <div className="history_title_card_right w-50">
                        <h4>350 </h4>
                      </div>
                    </div>
                    <div className="history_row_item d-flex align-items-center">
                      <div className="history_title_card_left w-50">
                        <h4>Status :</h4>
                      </div>
                      <div className="history_title_card_right w-50">
                        <h4>Cancelled </h4>
                      </div>
                    </div>
                  </div>
                  <div className="history_card_area_box _history_box_ mb-5">
                    <div className="history_row_item d-flex align-items-center">
                      <div className="history_title_card_left w-50">
                        <h4>Order Id :</h4>
                      </div>
                      <div className="history_title_card_right w-50">
                        <h4>83474546784039156 </h4>
                      </div>
                    </div>
                    <div className="history_row_item d-flex align-items-center">
                      <div className="history_title_card_left w-50">
                        <h4>Date :</h4>
                      </div>
                      <div className="history_title_card_right w-50">
                        <h4>2022-05-23 </h4>
                      </div>
                    </div>
                    <div className="history_row_item d-flex align-items-center">
                      <div className="history_title_card_left w-50">
                        <h4>Amount :</h4>
                      </div>
                      <div className="history_title_card_right w-50">
                        <h4>350 </h4>
                      </div>
                    </div>
                    <div className="history_row_item d-flex align-items-center">
                      <div className="history_title_card_left w-50">
                        <h4>Status :</h4>
                      </div>
                      <div className="history_title_card_right w-50">
                        <h4>Cancelled </h4>
                      </div>
                    </div>
                  </div>

                 
                </div>

                <div className="col-lg-7">
                  <Subscriptionhistorydetail/>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default SubcriptionHistory;
