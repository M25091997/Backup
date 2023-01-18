import { useState, useEffect } from "react";

import Button from "react-bootstrap/Button";
import Modal from "react-bootstrap/Modal";
import axios from 'axios';

const Subscriptionitem = (props) => {
    const subsOrderData = props.x;
    const subsTotalData = props.y;
    const subsAddressData = props.z;
    
    const [show, setShow] = useState(false);

    const handleClose = () => setShow(false);
    const handleShow = () => setShow(true);

    const plusCart = async (qt,ca,or) => {
        const abc = parseInt(qt) + 1;
        const send_data = {
            "process_id" : or,
            "cart_id" : ca,
            "qty" : abc
        }
        try {
            const response = await axios({
                method: "POST",
                url: "https://cms.cybertizeweb.com/boxoniq-crm/api/droid/qty-update-web.php",
                data: send_data
            });
            console.log(response, 'hulu');
        } catch (err) {
            console.log(err);
        }
    }

    const minusCart = () => {
        if (qty == 1) {
            alert('Quantity cannot be zero');
            return;
        }
        const def = qty - 1;
       
    }
  return (
      <div className="col-lg-7">
          <div className="history_calculation_sidebar mb-lg-5">
              {subsOrderData && subsOrderData.length > 0 ? subsOrderData.map((item) => {
                return (
                    <>
                        <h3 className="subscription_title_item">
                            {item.title}
                        </h3>
                       {item.items && item.items.length > 0 ? item.items.map((it) => {
                        return (
                            <div key={it.item_id} className="history_product_box subscription_p_box d-flex align-items-start mb-4">
                                <div className="product_thum">
                                    <img
                                        src={it.img}
                                        alt=""
                                        style={{height:'100px',width:'100px'}}
                                    />
                                </div>
                                <div className="history_product_content ">
                                    <h5>{it.item_name}</h5>
                                    <div className="history_product_quantity d-flex align-items-center g-5">
                                        <div>
                                            <span className="product_qty">Quantity: {it.quantity}</span>
                                        </div>
                                        <span onClick={minusCart} style={{ fontSize: '20px', cursor: 'pointer', marginRight: '5px' }}>-</span>
                                        <input type="text"
                                            readOnly
                                            style={{ height: '20px', width:'50px' }}
                                            // step="1" min="1" name="quantity" 
                                            // onChange={changeQty} 
                                            value={it.quantity} title="Qty"
                                            // onChange={(e) => { setQty(e.target.value) }} 
                                            className="input-text qty text" />
                                        <span onClick={() => plusCart(it.quantity,it.cart_id,it.process_id)} style={{ fontSize: '20px', cursor: 'pointer', marginLeft: '5px' }}>+</span>
                                    </div>
                                    <div className="history_product_quantity d-flex align-items-center g-5">
                                        <div>
                                            <span className="product_qty">Total: ₹ {it.amount}</span>
                                        </div>
                                        <div>
                                            <span className="product_price">Attr: ₹ {it.attr_price}</span>
                                        </div>
                                    </div>
                                    <div>
                                        <div>
                                            {
                                                it.attribute && it.attribute.length > 0 ? it.attribute.map((atr) => {
                                                    return (
                                                        <span key={atr.attr_id} className="ml_price">{atr.attr_name}</span>
                                                    )
                                                }) : ""
                                            }
                                            
                                        </div>
                                        <div className="subscription_p_remove">
                                            <button className="order_remove_item">
                                                Remove Item
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        )
                       }) : ""}

                        
                    </>
                )
              }) : ""}

              <div className="history_product_box subscription_p_box sub_total_box  mb-4">
                  <div className="history_row_item d-flex align-items-center">
                      <div className="history_title_card_left w-50">
                          <h4>Sub Total :</h4>
                      </div>
                      <div className="history_title_card_right w-50">
                          <h4>₹ {subsTotalData.subtotal} </h4>
                      </div>
                  </div>
                  <div className="history_row_item d-flex align-items-center">
                      <div className="history_title_card_left w-50">
                          <h4>Bundle Discount :</h4>
                      </div>
                      <div className="history_title_card_right w-50">
                          <h4>₹ {subsTotalData.bundle_discount} </h4>
                      </div>
                  </div>
                  <div className="history_row_item d-flex align-items-center">
                      <div className="history_title_card_left w-50">
                          <h4>Total :</h4>
                      </div>
                      <div className="history_title_card_right w-50">
                          <h4>₹ {subsTotalData.total} </h4>
                      </div>
                  </div>
              </div>

              <div className="history_product_box subscription_p_box  mb-4">
                  <div className="total_price">
                      <h4>Total</h4>
                      <div className="price_del">
                          <span>
                              <del>₹ {subsTotalData.final_total}</del>
                          </span>
                      </div>
                      <div>
                          <span className="price_order">₹ 300</span>
                          <span className="discount">10% off </span>
                      </div>
                  </div>
              </div>

              <div className="history_product_box">
                  <h5 className="delivery_titile">Delivery Address</h5>
                  <div className="order_delivery_address ">
                      <div className="history_row_item d-flex align-items-center w-100">
                          <div className="history_title_card_left w-25">
                              <h4>Name:</h4>
                          </div>
                          <div className="history_title_card_right w-75">
                              <h4>{subsAddressData.name} </h4>
                          </div>
                      </div>
                      <div className="history_row_item d-flex align-items-center w-100">
                          <div className="history_title_card_left w-25">
                              <h4>Address:</h4>
                          </div>
                          <div className="history_title_card_right w-75">
                              <h4>{subsAddressData.address} </h4>
                          </div>
                      </div>
                      <div className="history_row_item d-flex align-items-center w-100">
                          <div className="history_title_card_left w-25">
                              <h4>Landmark:</h4>
                          </div>
                          <div className="history_title_card_right w-75">
                              <h4>{subsAddressData.landmark} </h4>
                          </div>
                      </div>
                      <div className="history_row_item d-flex align-items-center w-100">
                          <div className="history_title_card_left w-25">
                              <h4>State:</h4>
                          </div>
                          <div className="history_title_card_right w-75">
                              <h4>{subsAddressData.state} </h4>
                          </div>
                      </div>
                      <div className="history_row_item d-flex align-items-center w-100">
                          <div className="history_title_card_left w-25">
                              <h4>Pincode:</h4>
                          </div>
                          <div className="history_title_card_right w-75">
                              <h4>834003</h4>
                          </div>
                      </div>
                      <div className="history_row_item d-flex align-items-center w-100">
                          <div className="history_title_card_left w-25">
                              <h4>Phone:</h4>
                          </div>
                          <div className="history_title_card_right w-75">
                              <h4>9756826565</h4>
                          </div>
                      </div>
                  </div>
                  <Button variant="primary" onClick={handleShow}>
                      Edit
                  </Button>

                  <Modal show={show} onHide={handleClose}>
                      <Modal.Header closeButton>
                          <Modal.Title>Update Delivery Address</Modal.Title>
                      </Modal.Header>
                      <Modal.Body>
                          <div className="mb-3">
                              <input
                                  type="email"
                                  className="form-control mb-3"
                                  id="exampleFormControlInput1"
                                  placeholder="name"
                              />
                              <input
                                  type="email"
                                  className="form-control mb-3"
                                  id="exampleFormControlInput1"
                                  placeholder="address "
                              />
                              <input
                                  type="email"
                                  className="form-control mb-3"
                                  id="exampleFormControlInput1"
                                  placeholder="landmark"
                              />
                              <input
                                  type="email"
                                  className="form-control mb-3"
                                  id="exampleFormControlInput1"
                                  placeholder="state"
                              />
                              <input
                                  type="email"
                                  className="form-control mb-3"
                                  id="exampleFormControlInput1"
                                  placeholder="pincode"
                              />
                              <input
                                  type="email"
                                  className="form-control"
                                  id="exampleFormControlInput1"
                                  placeholder="phone"
                              />
                          </div>
                      </Modal.Body>
                      <Modal.Footer>
                          <Button variant="secondary" onClick={handleClose}>
                              Close
                          </Button>
                          <Button variant="primary" onClick={handleClose}>
                              Save Changes
                          </Button>
                      </Modal.Footer>
                  </Modal>
              </div>
              <div className="cancel_area mt-4  mb-2 mt-lg-5 mb-lg-4">
                  <button className="order_cancel_btn skip_cancel_btn">
                      Skip for this month
                  </button>
              </div>
              <div className="cancel_area pt-2 mb-2 mb-lg-5">
                  <button className="order_cancel_btn">
                      Cancel Subscription
                  </button>
              </div>
          </div>
      </div>
  )
}

export default Subscriptionitem