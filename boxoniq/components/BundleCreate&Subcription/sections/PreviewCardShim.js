import React from 'react';
import AttrShim from "./AttrShim";
import TitleShim from "./TitleShim";
import DescShim from "./DescShim";
import PriceShim from "./PriceShim";
import ImageShim from "./ImageShim";


const PreviewCardShim = () => {
  return (
      <div className="bundle_item">

          <div className="row">
              <div className="col-md-4 col-xs-4 cols-sm-4">
                  <div className="thum11">
                      <ImageShim/>
                  </div>
              </div>
              <div className="col-md-8 col-xs-8 cols-sm-8">
                  <div className="bundle_text">
                      <h3><TitleShim/></h3>
                      <p>
                          <DescShim/>
                      </p>
                      <div className="bundle_cart_prices d-flex">
                          <div className="bundle_price_one ">
                              <h6><PriceShim/></h6>
                          </div>
                          <div className="bundle_price_two ms-3">
                              <h6><PriceShim/></h6>
                          </div>
                          <div className="bundle_price_one ms-3">
                              <h6><PriceShim/></h6>
                          </div>
                      </div>
                      <div className="bundle_footer_btn">
                          <div className="remove_btn">
                              <button>Remove Item</button>
                          </div>
                          <div className="select_price">
                            <AttrShim/>
                              {/* <button>
                                  {" "}
                                  <img src="./image/₹.png" alt="" /> <AttrShim/>
                                  <img src="./image/Vector.png" alt="" />
                              </button> */}
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  )
}

export default PreviewCardShim