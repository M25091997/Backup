import { useState } from "react";
import { Offcanvas } from "react-bootstrap";
import Cartcontent from "./sections/Cartcontent";
import Router from 'next/router';


const Cart = () => {
  const [show, setShow] = useState(false);

  const handleClose = () => setShow(false);
  const handleShow = () => setShow(true);

  const proceed = () => {
    Router.push("/addressBook");
  }

  const selectCheckoutType = (type) => {
    localStorage.removeItem("checkout_type");
    localStorage.setItem('checkout_type', type);
  }

  return (
    <div>
      <div className="profile_section ">
        <div className="container-fluid p_50">
          <div className="row justify-content-center">
            <div className="col-12 col-lg-10">
              <div className="cart_inner_arae mt-5 cart_table mt-5">
                <table className="table table-responsive">
                  <thead>
                    <tr>
                      <th scope="col">
                        <div className="cart_h_title">
                          <h5>Category</h5>
                        </div>
                      </th>
                      <th scope="col">
                        <div className="cart_h_title">
                          <h5>Item</h5>
                        </div>
                      </th>
                      <th scope="col">
                        <div className="cart_h_title">
                          <h5>QUANTITY</h5>
                        </div>
                      </th>
                      <th scope="col">
                        <div className="cart_h_title">
                          <h5>PRICE</h5>
                        </div>
                      </th>
                      <th scope="col">
                        <div className="cart_h_title">
                          <h5>TOTAL</h5>
                        </div>
                      </th>
                      <th scope="col">
                        <div className="cart_h_title">
                          <h5>ACTION</h5>
                        </div>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <Cartcontent/>
                   
                  </tbody>
                </table>
                <div className="row">
                  <div className="col-lg-12">
                    <div className="proceing_billing">
                      <button
                        className="proceing_billing_btn"
                        onClick={handleShow}
                      >
                        Proceed to Billing
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <Offcanvas show={show} onHide={handleClose} placement="end">
        <Offcanvas.Header closeButton>
          <Offcanvas.Title></Offcanvas.Title>
        </Offcanvas.Header>
        <Offcanvas.Body>
          <section className="billing">
            <div className="container">
              <div className="row justify-content-center">
                <div className="col-lg-12">
                  <div className="coupon-container">
                    <div className="coupon-title">
                      <h1>Coupons</h1>
                    </div>
                    <div className="coupon-details d-flex align-items-center">
                      <div className="dot">
                        <img
                          src="https://i.ibb.co/88YtbhN/Ellipse-31.png"
                          alt=""
                        />
                      </div>
                      <div className="coupon-title">
                        <h5>User100</h5>
                        <h6>Get Flat 500 using this code</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div className="row justify-content-center">
                <div className="col-lg-12">
                  <div className="coupon_itmes d-flex justify-content-between">
                    <div className="coupon_left_items">
                      <h6>Sub Total</h6>
                      <h6>Bundle Discount</h6>
                      <h6>Coupon Discount</h6>
                      <h6>Discount Charges</h6>
                      <h6>Total</h6>
                    </div>
                    <div className="coupon_right_items">
                      <h3>₹350</h3>
                      <h3>-₹350</h3>
                      <h3>-₹350</h3>
                      <h3>₹50</h3>
                      <h3>₹250</h3>
                    </div>
                  </div>
                </div>
              </div>
              <div className="row justify-content-center">
                <div className="col-lg-12">
                  <div className="checkout-container">
                    <div className="checkout-title">
                      <h1>Checkout or Subscribe</h1>
                    </div>
                    {/* <form className="mt-2">
                      <textarea
                        className="form-control text-area"
                        placeholder="Monthly Subscription"
                        id="exampleFormControlTextarea1"
                        rows="2"
                      ></textarea>
                      <input
                        type="email"
                        className="form-control checkout my-3"
                        id="exampleFormControlInput1"
                        placeholder="One Time Purchase"
                      />
                    </form> */}
                    <div className="form-check">
                      <input
                        className="form-check-input form_radio"
                        type="radio"
                        name="flexRadioDefault"
                        id="flexRadioDefault1"
                        onClick={()=>selectCheckoutType(0)}
                      />
                      <label
                        className="form-check-label"
                        htmlFor="flexRadioDefault1"
                      >
                        <input
                          type="email"
                          className="form-control checkout my-3"
                          id="exampleFormControlInput1"
                          placeholder="Monthly Subscription"
                        />
                      </label>
                    </div>
                    <div className="form-check">
                      <input
                        className="form-check-input form_radio"
                        type="radio"
                        name="flexRadioDefault"
                        id="flexRadioDefault2"
                        onClick={() => selectCheckoutType(1)}
                      />
                      <label
                        className="form-check-label"
                        htmlFor="flexRadioDefault2"
                      >
                        <input
                          type="email"
                          className="form-control checkout my-3"
                          id="exampleFormControlInput1"
                          placeholder="One Time Purchase"
                        />
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div className="row justify-content-center pb-5">
                <div className="col-lg-12">
                  <div className="billing-button">
                    <button href="" className="btn checkout-btn" onClick={() => proceed()}>
                      Proceed
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </Offcanvas.Body>
      </Offcanvas>
    </div>
  );
};

export default Cart;
