import Orderhistorydetail from "./sections/Orderhistorydetail";

const OrderHistory = () => {
  return (
    <div>
      <div className="profile_section">
        <div className="container-fluid p_50">
          <div className="row">
            <div className="col-lg-12">
              <div className="global_header text-center history_header py-lg-5">
                <h4 className="global_herder_title py-lg-3">Order History</h4>
              </div>
            </div>
            <div className="col-lg-12">
              <div className="row">
                <div className="col-lg-5">
                  <div className="history_card_area_box mb-5">
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

                  <div className="history_card_area_box mb-5">
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
                  <Orderhistorydetail/>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default OrderHistory;
