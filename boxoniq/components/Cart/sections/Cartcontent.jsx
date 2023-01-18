import { useState, useEffect } from "react";
import axios from "axios";
import Router from 'next/router';

const Cartcontent = () => {
    const [cartData, setCartData] = useState([]);
    
    const getBundle = async () => {
        const useNme = localStorage.getItem('name');
        const useId = localStorage.getItem('user_id');
        if (useNme == null || useId == null) {
            Router.push('../login');
            return;
        }
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
            setCartData(response.data);
        } catch (err) {
            console.log(err);
        }
    };

    const changeQty = async (cartId,proId,qty,price,key) => {
        const qty_data = {
            "user_id": 2,
            "product_id": proId,
            "cart_id": cartId,
            "key": key,
            "qty": qty,
            "mrp": price
        }
     
        try {
            const response = await axios({
                method: "POST",
                url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/change-qty-cart-web-bo.php",
                data: qty_data
            });
            alert(response.data.msg);
            setCartData([]);
            getBundle();
        } catch (err) {
            console.log(err);
        }
    };

    const deleteCart = async (cartId) => {
        const delete_data = {
            "cart_id" : cartId
        }
        try {
            const response = await axios({
                method: "POST",
                url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/delete-item-cart-web-bo.php",
                data: delete_data
            });
            alert(response.data.msg);
            setCartData([]);
            getBundle();
        } catch (err) {
            console.log(err);
        }
    };

    useEffect(() => {
        getBundle();
    }, []);
  return (
      <>
          {
              cartData && cartData.length > 0 ? cartData.map((item) => {
                  return (
                      <tr key={item.id} className="table_row_cart">
                          <td className="padd_right">
                              <div className="common_title">
                                  <h6>{item.title}</h6>
                              </div>
                          </td>

                          <td colSpan={4} className="p-0 m-0">
                              <table className="w-100 inner_table">
                                  <tbody>
                                      {item.product && item.product.length>0 ? item.product.map((pro) => {
                                        return (
                                            <tr key={pro.id} className="table_row_cart">
                                                <td className="w-25 w_70">
                                                    <div className="common_title">
                                                        <h6>{pro.item_name}</h6>
                                                    </div>
                                                </td>
                                                <td className="w_40">
                                                    <div className="quantity w-75 d-flex justify-content-center align-items-center quantity_gap ">
                                                        <div className="minus common_title " style={{ cursor: 'pointer' }} onClick={() => changeQty(pro.id, pro.item_id, 1, pro.item_price, 'minus')}>
                                                            <span>-</span>
                                                        </div>
                                                        <div className="value common_title">
                                                            <span>{pro.quantity}</span>
                                                        </div>
                                                        <div className="plus common_title" style={{cursor:'pointer'}} onClick={() => changeQty(pro.id,pro.item_id,1,pro.item_price,'plus')}>
                                                            <span>+</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td className="position-relative">
                                                    <div className="common_title">
                                                        <h6 className="shapo_p">{pro.item_price}</h6>
                                                    </div>
                                                </td>
                                                <td className="position-relative">
                                                    <div className="common_title">
                                                        <h6 className="shapo_q">{pro.total_amount}</h6>
                                                    </div>
                                                </td>
                                                <td className="position-relative" style={{paddingLeft:'100px'}}>
                                                    <div className="common_title" onClick={() => deleteCart(pro.id)} style={{cursor:'pointer'}}>
                                                        <img src="/images/bin.png" alt="" />
                                                    </div>
                                                </td>
                                                
                                            </tr>
                                        )
                                      }) : ""}
                                      
                                  </tbody>
                              </table>
                          </td>
                      </tr>
                  )
              }) : ""
          }

      </>
  )
}

export default Cartcontent