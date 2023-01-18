import { useState, useEffect } from "react";
import axios from "axios";

const NewAdress = () => {
  const [stateData, setStateData] = useState([]);
  const [username, setUsername] = useState('');
  const [phone, setPhone] = useState('');
  const [address, setAddress] = useState('');
  const [pincode, setPincode] = useState('');
  const [landmark, setLandmark] = useState('');
  const [statename, setStatename] = useState('');



  const send_data = {
    "account_id": 1,
    "full_address": address,
    "user_name" : username,
    "phone" : phone,
    "address_type" : "home",
    "landmark" : landmark,
    "pincode" : pincode,
    "state" : statename
  }
  const sendAddress = async () => {
    try {
      const response = await axios({
        method: "POST",
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/add-new-address-web-bo.php",
        data: send_data
      });
      console.log(response, 'hulu');
      if (response.data.response == 1) {
        alert(response.data.msg);
      }
    } catch (err) {
      console.log(err);
    }
  }; 

  const getBundle = async () => {
    try {
      const response = await axios({
        method: "GET",
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/get-states-bo.php"
      });
      console.log(response, 'hulu');
      setStateData(response.data);
    } catch (err) {
      console.log(err);
    }
  };
  useEffect(() => {
    getBundle();
  }, []);
  return (
    <div>
      <div className="profile_section">
        <div className="container-fluid p_50">
          <div className="row">
            <div className="col-lg-12">
              <div className="global_header text-center history_header py-lg-5">
                <h4 className="global_herder_title">Add New Address</h4>
              </div>
            </div>

            <div className="colg-lg-12">
              <div className="row">
                <div className="col-lg-5 mb-3">
                  <div className=" ">
                    <div className="add_new_add_btn_area mt-5 mt-lg-0 mb-3">
                      <button className="common_btn_btn cancel_btn w-100 d-flex justify-content-around">
                        <span>Saved Address</span>
                        <span>2</span>
                      </button>
                    </div>
                    <div className="add_new_add_btn_area">
                      <button className="common_btn_btn active_btn w-100 d-flex justify-content-around">
                        <span>Add Address</span> <span></span>
                      </button>
                    </div>
                  </div>
                </div>

                <div className="col-lg-7">
                  <div className="history_calculation_sidebar">
                    <div className="row">
                        <div className="col-lg-6 col-md-6">
                            <div className="add_new_address">
                              <h3 className="subscription_title_item">User Name</h3>
                              <div className=" mb-3">
                                <div className="wallet_price">
                                  <input
                                    type="text"
                                    className=" form-control wallet_input w-100"
                                    placeholder="Enter Your Name"
                                    value={username}
                                    onChange={(e) => setUsername(e.target.value)}
                                  />
                                </div>
                              </div>
                            </div>
                        </div>
                      <div className="col-lg-6 col-md-6">
                        <div className="add_new_address">
                          <h3 className="subscription_title_item">Phone No</h3>
                          <div className=" mb-3">
                            <div className="wallet_price">
                              <input
                                type="number"
                                className=" form-control wallet_input w-100"
                                placeholder="Enter Your Phone"
                                value={phone}
                                onChange={(e) => setPhone(e.target.value)}
                              />
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div className="add_new_address">
                      <h3 className="subscription_title_item">Address</h3>
                      <div className=" mb-3">
                        <div className="wallet_price">
                          <textarea
                            name=""
                            className=" form-control wallet_input w-100"
                            id=""
                            cols="30"
                            rows="5"
                            value={address}
                            onChange={(e) => setAddress(e.target.value)}
                          >
                          </textarea>
                        </div>
                      </div>
                    </div>

                    <div className="row">
                      <div className="col-lg-6 col-md-6">
                        <div className="add_new_address">
                          <h3 className="subscription_title_item mt-4">State</h3>
                          <div className=" mb-3">
                            <div className="wallet_price_address">
                              <select
                                name=""
                                id=""
                                className=" form-control wallet_input_select w-100 text-center"
                                value={statename}
                                onChange={(e) => setStatename(e.target.value)}
                              >
                                <option value="">Select state</option>
                                {stateData && stateData.length > 0 ? stateData.map((item) => {
                                  return (
                                    <option key={item.id} value={item.name}>{item.name}</option>
                                  )
                                }) : ""}
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div className="col-lg-6 col-md-6">
                        <div className="add_new_address">
                          <h3 className="subscription_title_item mt-4">Pincode</h3>
                          <div className=" mb-3">
                            <div className="wallet_price">
                              <input
                                type="text"
                                className=" form-control wallet_input w-100"
                                placeholder="Enter Your Pincode"
                                value={pincode}
                                onChange={(e) => setPincode(e.target.value)}
                              />
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div className="add_new_address">
                      <h3 className="subscription_title_item mt-4">Landmark</h3>
                      <div className=" mb-3">
                        <div className="wallet_price">
                          <input
                            type="text"
                            className=" form-control wallet_input w-100"
                            placeholder="Enter Your Landmark"
                            value={landmark}
                            onChange={(e) => setLandmark(e.target.value)}
                          />
                        </div>
                      </div>
                    </div>

                    <div className="skip_address_btn_area pt-4 pt-lg-4 pb-lg-5 ">
                      <button className="skip_address_btn w-100" onClick={() => sendAddress()}>Save</button>
                    </div>
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

export default NewAdress;
