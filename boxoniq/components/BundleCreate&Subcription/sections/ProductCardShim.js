import React from 'react';
import AttrShim from "./AttrShim";
import TitleShim from "./TitleShim";
import DescShim from "./DescShim";
import PriceShim from "./PriceShim";
import ImageShim from "./ImageShim";


const ProductCardShim = () => {
  return (
      <div className="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-4 mb-sm-4 mb-md-0 mb-lg-0 mt-3">
          <div className="bundle_cart_details d-flex">
              <div className="bundle_cart_img">
                   <ImageShim />
              </div>
              <div className="bundle_cart_price_quantity">
                  <h3> <TitleShim /></h3>
                  <h6><DescShim /> </h6>
                  <div className="bundle_cart_prices d-flex">
                      <div className="bundle_price_one ">
                          <h6><PriceShim /></h6>
                      </div>
                      <div className="bundle_price_two ms-3">
                          <h6> <PriceShim /></h6>
                      </div>
                      <div className="bundle_price_one ms-3">
                          <h6><PriceShim /></h6>
                      </div>
                  </div>
                  <div className="bundle_price_gm">
                      
                        <div className=" d-flex justify-content-between"><AttrShim /><AttrShim /><AttrShim /><AttrShim /></div>
                      
                  </div>
                  <div className="bundle_cart_buttons mt-4">
                      <button
                          className="minus_btn "
                      >
                          -
                      </button>
                      <span><PriceShim /></span>
                      <button className="plus_btn">
                          +
                      </button>
                      <button className="add_box">Add to box</button>
                  </div>
              </div>
          </div>
      </div>
  )
}

export default ProductCardShim