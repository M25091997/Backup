import React from 'react';
import Shim from '../../Shim';


const AddressShim = () => {
  return (
      <div className="address_book_area_box mb-5">
          <div className="add_content d-flex justify-content-between align-items-start">
              <div className="address_text">
                  <Shim height={'30px'} width={'150px'} border={'2px'} top={'8px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3 '} />
                  <Shim height={'30px'} width={'500px'} border={'2px'} top={'8px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3 '} />
                  <Shim height={'30px'} width={'200px'} border={'2px'} top={'8px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3 '} />
                  <Shim height={'30px'} width={'250px'} border={'2px'} top={'8px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3 '} />
              </div>
              <div className="address_icon ">
                  <div className="mb-3" style={{ cursor: 'pointer' }}>
                      <img
                          className="cur_pointer"
                          src="https://i.ibb.co/M6QSJJq/dustbin-1-1.png"
                          alt=""
                      />
                  </div>
                  <div style={{ cursor: 'pointer' }}>
                      <img
                          className="cur_pointer"
                          src="https://i.ibb.co/ZV3d6rf/pen-1.png"
                          alt=""
                      />
                  </div>
              </div>
          </div>
          <div className="skip_address_btn_area">
              <button className="skip_address_btn w-100">
                  Ship to this address1
              </button>
          </div>
      </div>
  )
}

export default AddressShim