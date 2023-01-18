import { useState, useEffect } from "react";
import axios from "axios";
import Router from 'next/router';
import Link from "next/link";
import { base_url } from '../../helpers/urlConfig';
import PreviewCardShim from "./sections/PreviewCardShim";
import PriceShim from "./sections/PriceShim";



const BundlePreview = () => {
  const [coupons, setCoupons] = useState([]);
  const [cartData, setCartData] = useState([]);
  const [totalData, setTotalData] = useState({});
  const [userId, setUserId] = useState('');
  const [coupondiscount, setCoupondiscount] = useState(0);
  const [delcharge, setDelcharge] = useState(0);

  const [couponmsg, setCouponmsg] = useState('');
  const [coupontitle, setCoupontitle] = useState('');


  const getBundle = async () => {
    const useNme = localStorage.getItem('name');
    const useId = localStorage.getItem('user_id');
    if (useNme == null || useId == null) {
      Router.push('../login');
      return;
    }
    setUserId(useId);
    const send_data = {
      "user_id": useId
    }
    try {
      const response = await axios({
        method: "POST",
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/get-cart-web-bo.php",
        data: send_data
      });
      // console.log(response, 'hulu');
      setCartData(response.data.cartItem);
      setTotalData(response.data.total);
      setDelcharge(response.data.total.del_charge);
    } catch (err) {
      console.log(err);
    }
  };

  const getCoupon = async () => {
   
    try {
      const response = await axios({
        method: "GET",
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/get-coupon-web-bo.php",
      });
      // console.log(response, 'hulu');
      setCoupons(response.data);
    } catch (err) {
      console.log(err);
    }
  };

  const selectCoupon = async (couponId) => {
    const coupon_data = {
      "coupon": couponId,
      "account_id" : userId
    }
    try {
      const response = await axios({
        method: "POST",
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/apply-coupon-web-bo.php",
        data: coupon_data
      });
      // console.log(response,'niks');
      if(response.data.response == '1'){
        localStorage.removeItem('coupon_discount');
        localStorage.setItem('coupon_discount', response.data.discount);

        setCoupondiscount(response.data.discount);
        setCouponmsg(response.data.msg);
        setCoupontitle(response.data.coupon_title);
      }
    } catch (err) {
      console.log(err);
    }
  };

  const deleteCart = async (cartId) => {
    const delete_data = {
      "cart_id": cartId
    }
    try {
      const response = await axios({
        method: "POST",
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/delete-item-cart-web-bo.php",
        data: delete_data
      });
      // alert(response.data.msg);
      setCartData([]);
      getBundle();
    } catch (err) {
      console.log(err);
    }
  };

  const selectCheckoutType = (type) => {
    localStorage.removeItem("checkout_type");
    localStorage.setItem('checkout_type', type);
  }

  const goToAddress = async() => {
    const checkType = localStorage.getItem('checkout_type');
    if(checkType == null || checkType == undefined){
      alert('Select Checkout Type First');
    }
    if(checkType == 0){
      const delete_data = {
        "account_id": userId
      }
      try {
        const response = await axios({
          method: "POST",
          url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/check-active-subscription-web-bo.php",
          data: delete_data
        });
        if(response.data.response == 0){
          Router.push('/addressBook');
        }else{
          alert("You have already a active Subscription");
        }
      } catch (err) {
        console.log(err);
      }
    }
    if(checkType==1){
      Router.push('/addressBook');
    }
  }

  const addMoreItem = () => {
    Router.push('/bundleCreator');
  }

  useEffect(() => {
    getBundle();
    getCoupon();
  },[]);
  return (
    <div className="">
      <div className="ornanic-section">
        <div className="bundle_sub_section">
          {
          // cartData && cartData.length > 0 ? 
            <div className="container-fluid ">
              <div className="row">
                <div className="col-lg-12">
                  <div className="bundle_wrap">
                    <div className="bundle_heading">
                      <h1>Bundle Preview</h1>
                      <button onClick={() => addMoreItem()} className="add_more_btn"> + Add more Items</button>
                    </div>
                    <p>
                      Preview Seclected items, varients & proceed with
                      subscription
                    </p>
                  </div>
                </div>
              </div>
              <div className="row">
                <div className="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <div className="row">
                    {cartData && cartData.length > 0 ? cartData.map((item) => {
                      return (
                        <div key={item.id} className="col-lg-12 mb-3">
                          <div className="cat">
                            <h2>{item.title}</h2>
                          </div>
                          {item.product && item.product.length > 0 ? item.product.map((pro) => {
                            return (
                              <div key={pro.id} className="bundle_item">

                                <div className="row">
                                  <div className="col-md-4 col-xs-4 cols-sm-4">
                                    <div className="thum11">
                                      <img
                                        src={pro.image}
                                        alt=""
                                        style={{ width: '100px', height: '100px' }}
                                      />
                                    </div>
                                  </div>
                                  <div className="col-md-8 col-xs-8 cols-sm-8">
                                    <div className="bundle_text">
                                      <h3>{pro.item_name}</h3>
                                      <p>
                                        Contains 14 essential vitamins and minerals. Vegan,
                                        USDA certified organic, and nonGMO.
                                      </p>
                                      <div className="bundle_cart_prices d-flex">
                                        <div className="bundle_price_one ">
                                          <h6>Price: ₹ {pro.item_price}</h6>
                                        </div>
                                        <div className="bundle_price_two ms-3">
                                          <h6>Quantity : {pro.quantity}</h6>
                                        </div>
                                        <div className="bundle_price_discount ms-3">
                                          <h6>Total: ₹ {pro.total_amount}</h6>
                                        </div>
                                      </div>
                                      <div className="bundle_footer_btn">
                                        <div className="remove_btn">
                                          <button onClick={() => deleteCart(pro.id)}>Remove Item</button>
                                        </div>
                                        <div className="select_price">
                                          <button>
                                            {" "}
                                            <img src="./image/₹.png" alt="" /> {pro.attribute}
                                            <img src="./image/Vector.png" alt="" />
                                          </button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            )
                          }) : ""}
                        </div>
                      )
                    }) : <><PreviewCardShim/><PreviewCardShim/></>}
                  </div>
                </div>

                <div className="col-lg-3 col-md-3 col-sm-12 col-xs-12 mb-3">
                  <div className="bundle_calculate">
                    <div className="bundle_sub_total_item">
                      <div className="coupon_title ">
                        <h3 className="font_w_b">Apply a Coupon?</h3>
                      </div>
                      <div className="bundle_sub_total_item">
                        
                        <div className="form-check">
                          {coupons && coupons.length > 0 ? coupons.map((item) => {
                            return (
                              <div key={item.coupon_id}>
                                <input
                                  className="form-check-input onetime_checked_form"
                                  type="radio"
                                  name="flexRadioDefault"
                                  id="flexRadioDefault2"
                                  onClick={() => selectCoupon(item.coupon)}
                                />
                                <h6 style={{ fontWeight: 'bolder' }}>{item.coupon}</h6>
                                <p style={{ fontSize: '12px' }}>{item.msg}</p>
                              </div>
                            )
                          }):""
                        }
                        </div>
                      </div>
                    </div>

                    <div className="bundle_sub_total_item">
                      <div className="row">
                        <div className="col-lg-12">
                          <div className="sub_total_title">
                            <h3>Sub Total</h3>
                            <div className="sub_price">₹{totalData && totalData != "" ? totalData.sub_total : <PriceShim/>}.00</div>
                          </div>
                        </div>
                      </div>
                      <div className="row">
                        <div className="col-lg-12">
                          <div className="sub_total_title">
                            <h3>
                              Bundle Discount
                            </h3>
                            <div className="sub_price">- ₹ {totalData && totalData != "" ? totalData.bundle_discount : <PriceShim/>}.00</div>
                          </div>
                        </div>
                      </div>
                      <div className="row">
                        <div className="col-lg-12">
                          <div className="sub_total_title">
                            <h3>
                              Coupon Discount
                            </h3>
                            <div className="sub_price">- ₹ {coupondiscount}.00</div>
                          </div>
                        </div>
                      </div>
                      <div className="row">
                        <div className="col-lg-12">
                          <div className="sub_total_title">
                            <h3>
                              Delivery Charge
                            </h3>
                            <div className="sub_price">+ ₹ {delcharge}.00</div>
                          </div>
                        </div>
                      </div>
                      <div className="row">
                        <div className="col-lg-12">
                          <div className="sub_total_title pt_50">
                            <h3>Total</h3>
                            <div className="sub_price">₹ {totalData && totalData != "" ? totalData.sub_total - coupondiscount + delcharge : <PriceShim/>}.00</div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <h2 className="check_out_sub">Checkout or Subscribe</h2>
                    <div className="bundle_sub_total_item">
                      <div className="form-check">
                        <input
                          className="form-check-input monthly_checked_form"
                          type="radio"
                          name="flexRadioDefault"
                          id="flexRadioDefault1"
                          onClick={() => selectCheckoutType(0)}
                        />
                        <label
                          className="form-check-label"
                          htmlFor="flexRadioDefault1"
                        >
                          <div className="mb-3">
                            {/* <textarea
                            className="form-control form_monthly"
                            id="exampleFormControlTextarea1"
                            rows="3"
                            placeholder="Monthly Subscription"
                          ></textarea> */}
                            <input
                              type="email"
                              className="form-control form_yearly"
                              id="exampleFormControlInput1"
                              placeholder="Monthly Subscription"
                              style={{ lineHeight: '56px' }}
                            />
                          </div>
                        </label>
                      </div>
                      <div className="form-check">
                        <input
                          className="form-check-input onetime_checked_form"
                          type="radio"
                          name="flexRadioDefault"
                          id="flexRadioDefault2"
                          onClick={() => selectCheckoutType(1)}
                        />
                        <label
                          className="form-check-label"
                          htmlFor="flexRadioDefault2"
                        >
                          <div className="mb-3">
                            <input
                              type="email"
                              className="form-control form_yearly"
                              id="exampleFormControlInput1"
                              placeholder="One Time Purchase"
                            />
                          </div>
                        </label>
                      </div>
                    </div>
                    <div className="upadate_sub_btn mt-3">
                      <div className="row">
                        <div className="col-lg-12">
                          <button onClick={() => goToAddress()}>
                            <span className="subscription_btn">
                              Proceed
                              <img src="./image/right_arroe.png" alt="" />{" "}
                            </span>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div className="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                  {coupondiscount && coupondiscount > 0 ? 
                    <div className="bundle_sub_total_item new_year_coupon">
                      <div className="coupon_title ">
                        <h3 className="font_w_b">
                          {coupontitle} <img src="./image/new_arrow.png" alt="" />
                        </h3>
                      </div>
                      <div className="coupon_link">
                        <a href="">{couponmsg}</a>
                      </div>
                    </div> :
                    <div className="bundle_sub_total_item new_year_coupon">
                      <div className="coupon_title ">
                        <h3 className="font_w_b">
                          TRY A COUPON <img src="./image/new_arrow.png" alt="" />
                        </h3>
                      </div>
                      <div className="coupon_link">
                        <a href="">Coupon has been not been applied</a>
                      </div>
                    </div>
                  }
                </div>
              </div>
            </div>
          //  : 
          //   <center>
          //     <img style={{ width: '350px' }} src={base_url + "/images/emptycart.png"} alt="logo" />
          //     <h2>Cart is Empty...</h2><br />
          //     <button className="btn btn-primary">Continue Shopping</button>

          //   </center>
          }
          
          <div className="bundle_bg_shape">
            <div className="bundle_bg_warp"></div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default BundlePreview;
