import { useState, useEffect } from "react";
import axios from "axios";
import Router from 'next/router';
import AddressShim from "./AddressShim";

const Addresscontent = () => {
    const [addressData, setAddressData] = useState([]);

    const editAddress = (addId) => {
        Router.push("editAddress/" + addId);
    }

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
                url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/all-saved-address-bo.php",
                data: send_data
            });
            console.log(response, 'hulu');
            setAddressData(response.data);
        } catch (err) {
            console.log(err);
        }
    };

    const deleteAddress = async (add_id) => {
        try {
            const response = await axios({
                method: "POST",
                url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/delete-address-web-bo.php",
                data: {'address_id' : add_id, 'account_id' : 2}
            });
            console.log(response, 'hulu');
            if (response.data.response == 1) {
                alert(response.data.msg);
                setAddressData([]);
                getBundle();
            }
        } catch (err) {
            console.log(err);
        }
    }; 

    const goTopayment = (type) => {
        localStorage.removeItem("addressId");
        localStorage.setItem('addressId', type);
        const checkType = localStorage.getItem('checkout_type');
        if(checkType == 1){
            Router.push('normalCheckout');
        }

        if (checkType == 0) {
            Router.push('finalCheckout');
        }
        
    }

    useEffect(() => {
        getBundle();
    }, []);

  return (
      <div className="history_calculation_sidebar history_calculation_optional">
          {addressData && addressData.length > 0 ? addressData.map((item) => {
            return (
          <div key={item.addressId} className="address_book_area_box mb-5">
              <div className="add_content d-flex justify-content-between align-items-start">
                  <div className="address_text">
                      <h4>{item.user_name}</h4>
                      <h5>{item.address}</h5>
                      <h5>{item.landmark}</h5>
                      <h5>{item.pincode}</h5>
                      <h5>{item.phone}</h5>
                  </div>
                  <div className="address_icon ">
                            <div className="mb-3" style={{ cursor: 'pointer' }} onClick={() => deleteAddress(item.addressId)}>
                          <img
                              className="cur_pointer"
                              src="https://i.ibb.co/M6QSJJq/dustbin-1-1.png"
                              alt=""
                          />
                      </div>
                            <div style={{ cursor: 'pointer' }} onClick={() => editAddress(item.addressId)}>
                          <img
                              className="cur_pointer"
                              src="https://i.ibb.co/ZV3d6rf/pen-1.png"
                              alt=""
                          />
                      </div>
                  </div>
              </div>
              <div className="skip_address_btn_area">
                  <button onClick={() => goTopayment(item.addressId)} className="skip_address_btn w-100">
                      Ship to this address
                  </button>
              </div>
          </div>
            )
          }) : <><AddressShim /><AddressShim /></>}
      </div>
  )
}

export default Addresscontent