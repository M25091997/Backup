import Contactdetail from "./sections/Contactdetail";
import Contactform from "./sections/Contactform";

const ContactUs = () => {
  return (
    <div>
      <div className="profile_section ">
        <div className="container-fluid p_50">
          <div className="row">
            <div className="col-lg-12">
              <div className="global_header text-center history_header contact_header_g pt-lg-5">
                <h4 className="global_herder_title">Contact Us</h4>
              </div>
              <div className="contact_area_header mb-4 mb-lg-5">
                <div className="contact_area_header_title text-center pb-lg-5">
                  <h4>We are here to help you</h4>
                  <h5>
                    For any services related queries you can <br />
                    contact us anytime at
                  </h5>
                </div>
              </div>
            </div>

            <div className="colg-lg-12">
              <div className="row p_50">
              <Contactdetail/>
              <Contactform/>  
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default ContactUs;
