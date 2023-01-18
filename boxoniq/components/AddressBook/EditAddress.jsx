import { useState, useEffect } from "react";
import axios from "axios";

import Button from "react-bootstrap/Button";
import Form from "react-bootstrap/Form";1

const EditAddress = () => {
  const [addressData, setAddressData] = useState({});
  const [stateData, setStateData] = useState([]);
  const [username, setUsername] = useState('');
  const [phone, setPhone] = useState('');
  const [address, setAddress] = useState('');
  const [pincode, setPincode] = useState('');
  const [landmark, setLandmark] = useState('');
  const [statename, setStatename] = useState('');

  const update_data = {
    "addressId": 34,
    "full_address": address,
    "user_name": username,
    "phone": phone,
    "address_type": "home",
    "landmark": landmark,
    "pincode": pincode,
    "state": statename
  }
  const updateAddress = async () => {
    try {
      const response = await axios({
        method: "POST",
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/edit-address-web-bo.php",
        data: update_data
      });
      console.log(response, 'hulu');
      if (response.data.response == 1) {
        alert(response.data.msg);
      }
    } catch (err) {
      console.log(err);
    }
  };

  const getAddress = async () => {
    const send_data = {
      "user_id": 2,
      "address_id": 34
    }
    try {
      const response = await axios({
        method: "POST",
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/fetch-single-address-bo.php",
        data: send_data
      });
      console.log(response, 'hulu');
      setUsername(response.data.user_name);
      setPhone(response.data.phone);
      setPincode(response.data.pincode);
      setLandmark(response.data.landmark);
      setAddress(response.data.address);
      setStatename(response.data.state);


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
    getAddress();
    getBundle();
  }, []);

  return (
    <div>
      <div className="signup">
        <div className="container">
          <div className="row justify-content-center text-start mt-2 mt-lg-3  mb-0 mb-lg-2">
            <div className="col-12 col-md-5 col-lg-5">
              <div className="signup_title">
                <h1>Address</h1>
              </div>
            </div>
          </div>
          <div className="row justify-content-center text-start">
            <div className="col-12 col-md-5 col-lg-5">
              <div className="signup_form">
                <Form>
                  <Form.Group className="mb-3" controlId="formBasicEmail">
                    <Form.Label className="form_label">Name</Form.Label>
                    <Form.Control
                      className="form_control_group w-100"
                      type="name"
                      placeholder="Name"
                      value={username}
                      onChange={(e) => setUsername(e.target.value)}
                    />
                  </Form.Group>
                  <Form.Group className="mb-3" controlId="formBasicEmail">
                    <Form.Label className="form_label">Address</Form.Label>
                    <Form.Control
                      className="form_control_group w-100"
                      type="text"
                      placeholder="Enter Your Address"
                      value={address}
                      onChange={(e) => setAddress(e.target.value)}
                    />
                  </Form.Group>
                  <Form.Select
                    className="mb-3 form_slect"
                    aria-label="Default select example"
                    value={statename}
                    onChange={(e) => setStatename(e.target.value)}
                  >
                    <option>State</option>
                    {stateData && stateData.length > 0 ? stateData.map((item) => {
                      return (
                        <option key={item.id} value={item.name}>{item.name}</option>
                      )
                    }) : ""}
                  </Form.Select>

                  <Form.Group className="mb-3" controlId="formBasicEmail">
                    <Form.Label className="form_label">Pincode</Form.Label>
                    <Form.Control
                      className="form_control_group w-100"
                      type="text"
                      placeholder="Enter Pincode"
                      value={pincode}
                      onChange={(e) => setPincode(e.target.value)}
                    />
                  </Form.Group>
                  <Form.Group className="mb-3" controlId="formBasicEmail">
                    <Form.Label className="form_label">Landmark</Form.Label>
                    <Form.Control
                      className="form_control_group w-100"
                      type="text"
                      placeholder="Enter Landmark"
                      value={landmark}
                      onChange={(e) => setLandmark(e.target.value)}
                    />
                  </Form.Group>
                  <Form.Group className="mb-3" controlId="formBasicEmail">
                    <Form.Label className="form_label">
                      Mobile Number
                    </Form.Label>
                    <Form.Control
                      className="form_control_group w-100"
                      type="text"
                      placeholder="Enter Mobile Number"
                      value={phone}
                      onChange={(e) => setPhone(e.target.value)}
                    />
                  </Form.Group>

                  <Button
                    className="signup_button w-100 mb-2 mb-lg-5"
                    // type="submit"
                    onClick={() => updateAddress()}
                  >
                    Save
                  </Button>
                </Form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default EditAddress;
