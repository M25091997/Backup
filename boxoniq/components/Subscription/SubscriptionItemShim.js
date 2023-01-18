import React from 'react'
import Shim from '../Shim';

const SubscriptionItemShim = () => {
  return (
    <div className="history_product_box subscription_p_box d-flex align-items-start mb-4">
                                <div className="product_thum">
                                <Shim height={'200px'} width={'250px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3 '} />
                                </div>
                                <div className="history_product_content ">
                                  <h5>
                                  <Shim height={'20px'} width={'200px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3 '} />
                                  </h5>
                                  
                                  <div className='d-flex'>
                                  <Shim height={'20px'} width={'20px'} radius={'50%'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3 '} />
                                  <span className="quantity">
                                  <Shim left={"10px"} height={'20px'} width={'50px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3 '} />
                                  </span>
                                  <Shim height={'20px'} left={"10px"} width={'20px'} radius={'50%'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3 '} />
                                  </div>
                                  <div className="history_product_quantity d-flex align-items-center g-5" style={{marginTop: '10px'}}>
                                    <div>
                                      <span className="product_qty">
                                      <Shim top={'10px'} height={'20px'} width={'200px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3 '} />
                                      </span>
                                    </div>
                                    <div>
                                      <span className="product_price">
                                        <Shim top={'10px'}  height={'20px'} width={'200px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3 '} />
                                      </span>
                                    </div>
                                  </div>
                                  <div>
                                    <div className='d-flex'>

                                    </div>
                                    <div className="subscription_p_remove">
                                    <Shim top={'10px'}  height={'20px'} width={'200px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3 '} />
                                    <Shim top={'10px'}  height={'20px'} width={'200px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3 '} />

                                      
                                    </div>
                                  </div>
                                </div>
                              </div>
  )
}

export default SubscriptionItemShim