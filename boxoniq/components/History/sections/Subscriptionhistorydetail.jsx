import { useState, useEffect } from "react";
import axios from "axios";
import { useRouter } from 'next/router'
import Router from 'next/router';
import OrderHistoryShim from "./OrderHistoryShim";


const Subscriptionhistorydetail = () => {
    const router = useRouter();
    const { sid } = router.query;
    console.log(sid, 'nik');

    const [subsOrderData, setSubsOrderData] = useState([]);
    const [subsAddressData, setSubsAddressData] = useState({});
    const [subsTotalData, setSubsTotalData] = useState({});
    const [orderId, setorderId] = useState('');
    const [cancelkey, setCancelkey] = useState(0);


    
    const viewInvoice = () => {
        window.open('https://cms.cybertizeweb.com/boxoniq-crm/billing-desk/?id='+orderId,'_blank');
    }

    const cancelOrder = async() => {
        if (confirm("Do you really want to cancel!") == true) {
                    const useId = localStorage.getItem('user_id');
                    if (useId == null) {
                    Router.push('../login');
                    return;
                    }
                    const send_data = {
                        "user_id": useId,
                        "process_id": orderId
                    }
                    try {
                        const response = await axios({
                            method: "POST",
                            url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/cancel-subscription-order-web-bo.php",
                            data: send_data
                        });
                        // console.log(response.data, 'niks');
                        if(response.data.response == '1'){
                            setCancelkey(1);
                        }
                        
                    } catch (err) {
                        console.log(err);
                    }
            } else {
                    return;
                }
        
    }

    const getBlogDetail = async (orderid) => {
        setorderId(orderid);
        const send_data = {
            "process_id": orderid
        }
        try {
            const response = await axios({
                method: "POST",
                url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/get-order-details-subscription-web-bo.php",
                data: send_data
            });
            console.log(response.data, 'hulu');
            setSubsOrderData(response.data.items);
            setSubsAddressData(response.data.address);
            setSubsTotalData(response.data.total);
            if(response.data.total.status == '5'){
                setCancelkey(1);
            }
        } catch (err) {
            console.log(err);
        }
    };

    useEffect(() => {
        if (sid != undefined) {
            getBlogDetail(sid);
        }
    }, [sid]);
  return (
      <div className="history_calculation_sidebar">

          {
            subsOrderData && subsOrderData.length > 0 ? subsOrderData.map((item) => {
                return (
                    <div key={item.random} className="history_product_box d-flex align-items-center mb-3">
                        <div className="product_thum">
                            <img
                                src={item.img}
                                alt=""
                                style={{height:'100px', width:'100px'}}
                            />
                        </div>
                        <div className="history_product_content ">
                            <h5>{item.item_name}</h5>
                            <div className="history_product_quantity d-flex align-items-center g-5">
                                <div>
                                    <span className="product_qty">Quantity: {item.quantity}</span>
                                </div>
                                <div>
                                    <span className="product_price">Price: {item.item_price}</span>
                                </div>
                            </div>
                            <div className="total_area">
                                <div className="total_price">
                                    <h6>
                                        Total: <span>₹ {item.amount}</span>{" "}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                )
            }) :<><OrderHistoryShim /><OrderHistoryShim/></>
          }
          

          <div className="history_product_box sub_total_box  mb-3">
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
                      <h4>Coupon Discount</h4>
                  </div>
                  <div className="history_title_card_right w-50">
                      <h4>₹ 0 </h4>
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
                      <h4>Subscription Discount :</h4>
                  </div>
                  <div className="history_title_card_right w-50">
                      <h4>₹ {subsTotalData.subs_discount} </h4>
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

          <div className="history_product_box">
              <h5 className="delivery_titile">Delivery Address</h5>
              <div className="delivery_address">
                  <h5>{subsAddressData.address}</h5>
              </div>
              <h6 className="delivery_titile">Name</h6>
              <div className="delivery_address">
                  <h5>{subsAddressData.name}</h5>
              </div>
              <h6 className="delivery_titile">Phone</h6>
              <div className="delivery_address">
                  <h5>{subsAddressData.phone}</h5>
              </div>
              <h6 className="delivery_titile">Landmark</h6>
              <div className="delivery_address">
                  <h5>{subsAddressData.landmark}</h5>
              </div>
              <h6 className="delivery_titile">Pincode</h6>
              <div className="delivery_address">
                  <h5>{subsAddressData.pincode}</h5>
              </div>
              <h6 className="delivery_titile">State</h6>
              <div className="delivery_address">
                  <h5>{subsAddressData.state}</h5>
              </div>
          </div>
          <div className="cancel_area mt-5 mb-5">
            <div className="row">
                <div className="col-md-5">
                {cancelkey ? <button disabled style={{backgroundColor:"#df9696"}} className="order_cancel_btn">Cancelled</button> : 
                        <button onClick={() => cancelOrder()} className="order_cancel_btn">Cancel Order</button>
                        }
                </div>
                <div className="col-md-2"></div>
                  <div className="col-md-5">
                      {cancelkey || (subsTotalData.status != "3" && subsTotalData.status != "4") ? <button disabled onClick={() => viewInvoice()} className="order_cancel_btn" style={{background:'#92b590'}}>Invoice</button>
                  : <button onClick={() => viewInvoice()} className="order_cancel_btn" style={{background:'#09a42b'}}>Invoice</button>
                        }
                  </div>
            </div>
          </div>
      </div>
  )
}

export default Subscriptionhistorydetail