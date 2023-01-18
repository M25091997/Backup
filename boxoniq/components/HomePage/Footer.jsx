import {
  AiFillHome,
  AiFillPhone,
  AiFillPrinter,
  AiFillRedEnvelope,
} from "react-icons/ai";
import { GrFacebook, GrRss } from "react-icons/gr";
import {
  BsLinkedin,
  BsFillRssFill,
  BsTwitter,
  BsTelegram,
} from "react-icons/bs";
import { IoLogoYoutube } from "react-icons/io";
import { FaTelegramPlane } from "react-icons/fa";

const Footer = () => {
  return (
    <div style={{ backgroundColor: "#262626 ", color: "#fff9f9c9" }}>
      <div className="pt-4 ">
        <div className="container ">
          <div className="row mb-4">
            <div className="col-lg-6">
              <div className="follow_us_text_icons d-flex">
                <div className="follow_us_text">
                  <h2>Follow us on</h2>
                </div>
                <div className="follow_us_icons">
                  <BsTwitter className="twitter" />
                  <GrFacebook />
                  <BsLinkedin />
                  <IoLogoYoutube className="youtube" />
                  <BsFillRssFill />
                  <FaTelegramPlane className="telegram" />
                </div>
              </div>
            </div>
            <div className="col-lg-6">
              <div className="footer_images">
                <img
                  className="app_store py-3 py-lg-0"
                  src="https://i.ibb.co/z4g1yjS/A47-B9-C575-CC9-ABD2-A884-DBD85-D2414-B0-BB96-1.png"
                  alt=""
                />
                <img
                  className="app_store "
                  src="https://i.ibb.co/kSrnfTQ/appdownload-1.png"
                  alt=""
                />
              </div>
            </div>
          </div>
          <div className="row ">
            <div className="col-md-3 col-lg-3 col-xl-3  footer">
              <h5 className="footer_title text-uppercase mb-2 font-weight-bold text-white">
                HOME
              </h5>
              <ul style={{ listStyleType: "none", marginLeft: "-30px" }}>
                <li>
                  <a href="#">Home</a>
                </li>
                <li>
                  <a href="#">About Us</a>
                </li>
                <li>
                  <a href="#">Latest News</a>
                </li>
              </ul>
            </div>
            <div className="col-md-3 col-lg-3 col-xl-3  footer">
              <h5 className="footer_title text-uppercase mb-2 font-weight-bold text-white">
                TRENDING
              </h5>

              <ul style={{ listStyleType: "none", marginLeft: "-30px" }}>
                <li>
                  <a href="#">Home</a>
                </li>
                <li>
                  <a href="#">About Us</a>
                </li>
                <li>
                  <a href="#">Latest News</a>
                </li>
              </ul>
            </div>
            <div className="col-md-3 col-lg-3 col-xl-3  footer">
              <h5 className="footer_title text-uppercase mb-2 font-weight-bold text-white">
                SUPPORT
              </h5>

              <ul style={{ listStyleType: "none", marginLeft: "-30px" }}>
                <li>
                  <a href="#">Home</a>
                </li>
                <li>
                  <a href="#">About Us</a>
                </li>
                <li>
                  <a href="#">Latest News</a>
                </li>
              </ul>
            </div>
            <div className="col-md-3 col-lg-3 col-xl-3  footer">
              <h5 className="footer_title text-uppercase mb-2 font-weight-bold text-white">
                QUICK LINKS
              </h5>

              <ul style={{ listStyleType: "none", marginLeft: "-30px" }}>
                <li>
                  <a href="#">Home</a>
                </li>
                <li>
                  <a href="#">About Us</a>
                </li>
                <li>
                  <a href="#">Latest News</a>
                </li>
              </ul>
            </div>
          </div>

          <div className="row  mt-3 fw-bold">
            <div className="d-flex justify-content-center">
              <p>Copyright 2022 All Rights Reserved By Boxoniq </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Footer;
