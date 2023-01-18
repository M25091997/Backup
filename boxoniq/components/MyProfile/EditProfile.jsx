import { useState, useEffect } from "react";
import axios from "axios";

import Button from "react-bootstrap/Button";
import Form from "react-bootstrap/Form";1

const EditProfile = () => {
  const [username, setUsername] = useState('');
  const [phone, setPhone] = useState('');
  const [email, setEmail] = useState('');
  const [babyname, setBabyname] = useState('');
  const [babydob, setBabydob] = useState('');
  const [userId, setUserId] = useState('');


  
  const updateProfileDetail = async () => {
    // const useId = localStorage.getItem('user_id');

    const update_data = {
      "user_id": userId,
      "user_name": username,
      "phone": phone,
      "email" : email,
      "baby_name" : babyname,
      "baby_dob" : babydob
    }
    try {
      const response = await axios({
        method: "POST",
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/update-profile-web-bo.php",
        data: update_data
      });
      console.log(response, 'hulu');
      if (response.data.response == '1') {
        alert(response.data.msg);
      }
    } catch (err) {
      console.log(err);
    }
  };

  const getMyProfile = async () => {
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
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/get-user-web-bo.php",
        data: send_data
      });
      console.log(response, 'hulu');
      setUsername(response.data.name);
      setPhone(response.data.phone);
      setEmail(response.data.email);
      setBabyname(response.data.baby_name);
      setBabydob(response.data.baby_dob);
    } catch (err) {
      console.log(err);
    }
  };

  useEffect(() => {
    getMyProfile();
  }, []);

  return (
    <div>
      <div className="signup">
        <div className="container">
          <div className="row justify-content-center text-start mt-2 mt-lg-3  mb-0 mb-lg-2">
            <div className="col-12 col-md-5 col-lg-5">
              <div className="signup_title">
                <h1>Edit Profile Details</h1>
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

                  <Form.Group className="mb-3" controlId="formBasicEmail">
                    <Form.Label className="form_label">
                      Email
                    </Form.Label>
                    <Form.Control
                      className="form_control_group w-100"
                      type="email"
                      placeholder="Enter Email"
                      value={email}
                      onChange={(e) => setEmail(e.target.value)}
                    />
                  </Form.Group>

                  <Form.Group className="mb-3" controlId="formBasicEmail">
                    <Form.Label className="form_label">
                      Baby Name
                    </Form.Label>
                    <Form.Control
                      className="form_control_group w-100"
                      type="text"
                      placeholder="Enter Baby Name"
                      value={babyname}
                      onChange={(e) => setBabyname(e.target.value)}
                    />
                  </Form.Group>

                  <Form.Group className="mb-3" controlId="formBasicEmail">
                    <Form.Label className="form_label">
                      Baby Dob
                    </Form.Label>
                    <Form.Control
                      className="form_control_group w-100"
                      type="text"
                      placeholder="Enter Baby Dob"
                      value={babydob}
                      onChange={(e) => setBabydob(e.target.value)}
                    />
                  </Form.Group>

                  <Button
                    className="signup_button w-100 mb-2 mb-lg-5"
                    // type="submit"
                    onClick={() => updateProfileDetail()}
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

export default EditProfile;
