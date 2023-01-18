import { useState, useEffect } from "react";
import axios from "axios";
import Button from "react-bootstrap/Button";
import Modal from "react-bootstrap/Modal";
import { base_url } from '../../helpers/urlConfig';
import SubscriptionItemShim from "./SubscriptionItemShim";
import PriceShim from "./PriceShim";
import TitleShim from "./TitleShim";
import Router from 'next/router';


// import Subscriptionitem from "./sections/Subscriptionitem";

const Subscription = () => {
  
    const [subsOrderData, setSubsOrderData] = useState([]);
    const [subsAddressData, setSubsAddressData] = useState({});
    const [subsTotalData, setSubsTotalData] = useState({});
    const [subsAllData, setSubsAllData] = useState({});
    const [walletBalance, setWalletBalance] = useState();
  const [processId, setProcessId] = useState('');

  const [show, setShow] = useState(false);

  const handleClose = () => setShow(false);
  const handleShow = () => setShow(true);

  const goToWallet = () => {
    Router.push('/wallet');
  }

  const plusCart = async (qt, ca, or) => {
    const abc = parseInt(qt) + 1;
    const send_data = {
      "process_id": or,
      "cart_id": ca,
      "qty": abc
    }
    try {
      const response = await axios({
        method: "POST",
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/droid/qty-update-web.php",
        data: send_data
      });
      if(response.data.response == '1'){
        getActiveSubscription();
      }
    } catch (err) {
      console.log(err);
    }
  }
  const minusCart = async (qt, ca, or) => {
    if (qt == 1) {
      alert('Quantity cannot be zero');
      return;
    }
    const abc = parseInt(qt) - 1;
    const send_data = {
      "process_id": or,
      "cart_id": ca,
      "qty": abc
    }
    try {
      const response = await axios({
        method: "POST",
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/droid/qty-update-web.php",
        data: send_data
      });
      if (response.data.response == '1') {
        getActiveSubscription();
      }
    } catch (err) {
      console.log(err);
    }
  }

  const removeItemCart = async (ca, or) => {
    const send_data = {
      "process_id": or,
      "cart_id": ca
    }
    try {
      const response = await axios({
        method: "POST",
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/droid/remove-cart-item-web-bo.php",
        data: send_data
      });
      if (response.data.response == '1') {
        getActiveSubscription();
      }
    } catch (err) {
      console.log(err);
    }
  }

  const changeAttrCart = async (or, ca, at) => {
    const send_data = {
      "process_id": or,
      "cart_id": ca,
      "attr_id": at
    }
    try {
      const response = await axios({
        method: "POST",
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/droid/attr-update-web.php",
        data: send_data
      });
      if (response.data.response == '1') {
        alert("Successfully Changed attribute");
        getActiveSubscription();
      }
    } catch (err) {
      console.log(err);
    }
  }

  const getActiveSubscription = async () => {
    const useNme = localStorage.getItem('name');
    const useId = localStorage.getItem('user_id');
    if (useNme == null || useId == null) {
      Router.push('../login');
      return;
    }
    const send_data = {
      "account_id": useId
    }
    const get_wallet_data = {
      "user_id": useId
    }
    try {
      const response = await axios({
        method: "POST",
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/get-order-subscription-web-bo.php",
        data: send_data
      });
            // console.log(response.data,'sanvi');
            if(response.data.response == '1'){
              localStorage.setItem('activeProcessId', response.data.order_id);
              setProcessId(response.data.order_id);
              getBlogDetail(response.data.order_id);
            }
      const wallBalance = await axios({
        method: "POST",
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/get-wallet-amount-web.php",
        data: get_wallet_data
      });
      // console.log(wallBalance.data,'niks');
      if (wallBalance.data.response == 1) {
        setWalletBalance(wallBalance.data.wallet_balance);
      }

    } catch (err) {
      console.log(err);
    }
  };

  const cancelActiveSubscription = async() => {
    // alert('hi');
    // return;
    const send_data = {
      "process_id": processId
    }
    try {
      const response = await axios({
        method: "POST",
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/droid/cancel-item-sub-web.php",
        data: send_data
      });
      // console.log(response,'niks');
      if(response.data.response == 1){
        alert(response.data.msg);
        getActiveSubscription();
      }
    } catch (err) {
      console.log(err);
    }
  }

 

  const getBlogDetail = async (proId) => {
    const send_data = {
      "process_id": proId
    }
    try {
      const response = await axios({
        method: "POST",
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/droid/get-active-order-details-subscription-web-bo.php",
        data: send_data
      });
      // console.log(response,'niks');
            setSubsOrderData(response.data.order);
            setSubsAddressData(response.data.address);
            setSubsTotalData(response.data.total);
            setSubsAllData(response.data);
    } catch (err) {
      console.log(err);
    }
  };

  useEffect(() => {
    getActiveSubscription();
  }, []);
 
  return (
    <div>
      <div className="profile_section">
        <div className="container-fluid p_50">
          <div className="row">
            <div className="col-lg-12">
              {/* <div className="row">
                <div className="col-lg-12">
                  <div className="global_header text-center subscription_header history_header d-flex justify-content-between align-items-center">
                    <div></div>
                    <h4 className="global_herder_title subscription_header_title_order mt-lg-4">
                      Subscription
                    </h4>
                    <div>
                      <button onClick={() => Router.push('/activeSubscription')} className="order_add_items mt-lg-4">
                        + Add items
                      </button>
                    </div>
                  </div>
                </div>
              </div> */}
              <div className="row justify-content-center mt-5">
                <div className="col-lg-5 mb-5">
                  <div className="subscription_area_header ">
                    <div className="subscription_titile text-center">
                      <h4>My Bundle Subscription</h4>
                      <h4>Product delivered for {subsAllData.delivered} Months</h4>
                    </div>
                    <div className="subscription_header_box_area mt-5 ">
                      <div className="subscription_description text-center">
                        <p>
                          {subsAllData.nextdate}
                        </p>
                      </div>
                      <div className="manage_wallet_area d-flex align-items-center justify-content-between">
                        <button onClick={() => goToWallet()} className="manage_wallet_btn">
                          Manage Wallet
                        </button>
                        <h6 className="available_balance">
                          Available Balance : <span>₹ {walletBalance}</span>
                        </h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div className="col-lg-12 mt-5">
              <div className="row justify-content-center">
                {/* <Subscriptionitem x={subsOrderData} y={subsTotalData} z={subsAddressData}/> */}
                <div className="col-lg-7">
                  <div className="history_calculation_sidebar mb-lg-5">
                    <button onClick={() => Router.push('/activeSubscription')} className="primary" style={{ float: 'right', backgroundColor: 'rgb(9, 164, 43)',
                    borderRadius: '10%', padding: '10px', color:'#fff' }}>
                      + Add items
                    </button>
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
                                    style={{ height: '100px', width: '100px' }}
                                  />
                                </div>
                                <div className="history_product_content ">
                                  <h5>{it.item_name}</h5>
                                  <div className="history_product_quantity d-flex align-items-center g-5">
                                    {/* <div>
                                      <span className="product_qty">Quantity: {it.quantity}</span>
                                    </div> */}
                                    
                                    {/* <span onClick={() => minusCart(it.quantity, it.cart_id, it.process_id)} style={{ fontSize: '20px', cursor: 'pointer', marginRight: '5px' }}>-</span>
                                    <input type="text"
                                      readOnly
                                      style={{ height: '20px', width: '50px' }}
                                      // step="1" min="1" name="quantity" 1
                                      // onChange={changeQty} 
                                      value={it.quantity} title="Qty"
                                      // onChange={(e) => { setQty(e.target.value) }} 
                                      className="input-text qty text" />
                                    <span onClick={() => plusCart(it.quantity, it.cart_id, it.process_id)} style={{ fontSize: '20px', cursor: 'pointer', marginLeft: '5px' }}>+</span> */}
                                  </div>
                                  <div>
                                  <button
                                      className="plus_btn "
                                      onClick={() => minusCart(it.quantity, it.cart_id, it.process_id)} style={{ fontSize: '20px', cursor: 'pointer', marginRight: '10px' }}
                                  >
                                      -
                                  </button>
                                  <span className="quantity">{it.quantity}</span>
                                  <button
                                      className="minus_btn"
                                      onClick={() => plusCart(it.quantity, it.cart_id, it.process_id)} style={{ fontSize: '20px', cursor: 'pointer', marginLeft: '10px' }}
                                  >
                                      +
                                  </button>
                                  </div>
                                  <div className="history_product_quantity d-flex align-items-center g-5">
                                    <div>
                                      <span className="product_qty">Total: ₹ {it.amount}</span>
                                    </div>
                                    <div>
                                      <span className="product_price">Price: ₹ {it.attr_price}</span>
                                    </div>
                                  </div>
                                  <div>
                                    <div>
                                      {
                                        it.attribute && it.attribute.length > 0 ? it.attribute.map((atr) => {
                                          return (
                                            <span style={{cursor:'pointer'}} onClick={() => changeAttrCart(it.process_id, it.cart_id, atr.attr_id)} key={atr.attr_id} className="ml_price">{atr.attr_name}</span>
                                          )
                                        }) : 
                                          ""
                                      }

                                    </div>
                                    <div className="subscription_p_remove">
                                      <button onClick={() => removeItemCart(it.cart_id, it.process_id)} style={{ background: '#f70732', color: '#fff', fontWeight:'bold' }} className="order_remove_item">
                                        Remove Item
                                      </button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            )
                          }) : <SubscriptionItemShim />
                          }


                        </>
                      )
                    }) :
                      <center>
                        <img style={{ width: '350px' }} src={base_url + "/images/emptycart.png"} alt="logo" />
                        <h2>Cart is Empty...</h2><br />
                        <button className="btn btn-primary">Continue Shopping</button>

                      </center>  
                    }

                    {subsOrderData && subsOrderData.length > 0 ? 
                    <>
                          <div className="history_product_box subscription_p_box sub_total_box  mb-4">
                            <div className="history_row_item d-flex align-items-center">
                              <div className="history_title_card_left w-50">
                                <h4>Sub Total :</h4>
                              </div>
                              <div className="history_title_card_right w-50">
                                <h4>{subsTotalData && subsTotalData != undefined ? "₹" + subsTotalData.subtotal : <PriceShim/> } </h4>
                              </div>
                            </div>
                            <div className="history_row_item d-flex align-items-center">
                              <div className="history_title_card_left w-50">
                                <h4>Bundle Discount :</h4>
                              </div>
                              <div className="history_title_card_right w-50">
                                <h4>{subsTotalData && subsTotalData != undefined ? "₹" + subsTotalData.bundle_discount : <PriceShim/> } </h4>
                              </div>
                            </div>
                            <div className="history_row_item d-flex align-items-center">
                              <div className="history_title_card_left w-50">
                                <h4>Total :</h4>
                              </div>
                              <div className="history_title_card_right w-50">
                                <h4>{subsTotalData && subsTotalData != undefined ? "₹" + subsTotalData.total : <PriceShim/> } </h4>
                              </div>
                            </div>
                          </div>

                          <div className="history_product_box subscription_p_box  mb-4">
                            <div className="total_price">
                              <h4>Total</h4>
                              <div className="price_del">
                                <span>
                                  <del> {subsTotalData && subsTotalData != undefined ? "₹" + subsTotalData.final_total : <PriceShim/> }</del>
                                </span>
                              </div>
                              <div>
                                <span className="price_order">
                                {subsTotalData && subsTotalData != undefined ? "₹" + subsTotalData.final_total : <PriceShim/> }
                                </span>
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
                                  <h4>{subsAddressData && subsAddressData != undefined ? subsAddressData.name : <TitleShim/>} </h4>
                                </div>
                              </div>
                              <div className="history_row_item d-flex align-items-center w-100">
                                <div className="history_title_card_left w-25">
                                  <h4>Address:</h4>
                                </div>
                                <div className="history_title_card_right w-75">
                                  <h4>{subsAddressData && subsAddressData != undefined ? subsAddressData.address : <TitleShim/>} </h4>
                                </div>
                              </div>
                              <div className="history_row_item d-flex align-items-center w-100">
                                <div className="history_title_card_left w-25">
                                  <h4>Landmark:</h4>
                                </div>
                                <div className="history_title_card_right w-75">
                                  <h4>{subsAddressData && subsAddressData != undefined ? subsAddressData.landmark : <TitleShim/>} </h4>
                                </div>
                              </div>
                              <div className="history_row_item d-flex align-items-center w-100">
                                <div className="history_title_card_left w-25">
                                  <h4>State:</h4>
                                </div>
                                <div className="history_title_card_right w-75">
                                  <h4>{subsAddressData && subsAddressData != undefined ? subsAddressData.state : <TitleShim/>} </h4>
                                </div>
                              </div>
                              <div className="history_row_item d-flex align-items-center w-100">
                                <div className="history_title_card_left w-25">
                                  <h4>Pincode:</h4>
                                </div>
                                <div className="history_title_card_right w-75">
                                  <h4>{subsAddressData && subsAddressData != undefined ? subsAddressData.pincode : <TitleShim/>}</h4>
                                </div>
                              </div>
                              <div className="history_row_item d-flex align-items-center w-100">
                                <div className="history_title_card_left w-25">
                                  <h4>Phone:</h4>
                                </div>
                                <div className="history_title_card_right w-75">
                                  <h4>{subsAddressData && subsAddressData != undefined ? subsAddressData.phone : <TitleShim/>}</h4>
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
                            <button onClick={() => cancelActiveSubscription()} className="order_cancel_btn">
                              Cancel Subscription
                            </button>
                          </div>
                        </>
                     : ""}

                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Subscription;
