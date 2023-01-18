import React from 'react'
import ImageShim from './ImageShim'
import PriceShim from './PriceShim'
import TitleShim from './TitleShim'


const OrderHistoryShim = () => {
  return (
    <div  className="history_product_box d-flex align-items-center mb-3">
                            <div className="product_thum">
                                <ImageShim/>
                            </div>
                            <div className="history_product_content ">
                                <h5><TitleShim /></h5>
                                <div className="history_product_quantity d-flex align-items-center g-5">
                                    <div>
                                        <PriceShim />
                                    </div>
                                    <div>
                                    <PriceShim />
                                    </div>
                                </div>
                                <div className="total_area">
                                    <div className="total_price">
                                        <h6>
                                            <TitleShim />
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
  )
}

export default OrderHistoryShim