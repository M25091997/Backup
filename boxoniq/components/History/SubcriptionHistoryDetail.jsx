import Subscriptionhistorydetail from "./sections/Subscriptionhistorydetail";

const SubcriptionHistory = () => {
  return (
    <div>
      <div className="profile_section ">
        <div className="container-fluid p_50">
          <div className="row">
            <div className="col-lg-12">
              <div className="global_header text-center history_header py-lg-5">
                <h4 className="global_herder_title">Subscription Detail</h4>
              </div>
            </div>
            
            <div className="colg-lg-12">
              <div className="row">
                <div className="col-lg-3 col-md-3"></div>
                <div className="col-lg-6 col-md-6">
                  <Subscriptionhistorydetail />
                </div>
                <div className="col-lg-3 col-md-3"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default SubcriptionHistory;
