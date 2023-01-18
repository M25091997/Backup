import React from 'react'

const Contactform = () => {
  return (
      <div className="col-lg-7">
          <div className="history_calculation_sidebar">
              <div className="enquery_from">
                  <h4>Enquiry Form</h4>
              </div>
              <div className="add_new_address">
                  <h3 className="subscription_title_item">Name</h3>
                  <div className=" mb-3">
                      <div className="wallet_price">
                          <input
                              type="text"
                              className="form-control wallet_input w-100"
                              placeholder="Enter Your Name"
                          />
                      </div>
                  </div>
              </div>
              <div className="add_new_address">
                  <h3 className="subscription_title_item">Email</h3>
                  <div className=" mb-3">
                      <div className="wallet_price">
                          <input
                              type="text"
                              className="form-control wallet_input w-100"
                              placeholder="Enter Your Email "
                          />
                      </div>
                  </div>
              </div>

              <div className="add_new_address">
                  <h3 className="subscription_title_item">Phone number</h3>
                  <div className=" mb-3">
                      <div className="wallet_price">
                          <input
                              type="text"
                              className="form-control wallet_input w-100"
                              placeholder="Enter Your Phone number "
                          />
                      </div>
                  </div>
              </div>
              <div className="add_new_address">
                  <h3 className="subscription_title_item">
                      Please write your comment
                  </h3>
                  <div className=" mb-3">
                      <div className="wallet_price">
                          <textarea
                              name=""
                              className=" form-control wallet_input w-100"
                              id=""
                              cols="30"
                              rows="5"
                          ></textarea>
                      </div>
                  </div>
              </div>

              <div className="skip_address_btn_area mt-lg-5">
                  <button className="skip_address_btn w-100">Submit</button>
              </div>
          </div>
      </div>
  )
}

export default Contactform