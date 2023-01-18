import React, { useState, useEffect } from 'react'
import axios from 'axios';
import Router from 'next/router';

import Button from "react-bootstrap/Button";
import Form from "react-bootstrap/Form";

const Register = () => {
  const [name, setName] = useState('');
  const [mobile, setMobile] = useState('');
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [babyname, setBabyname] = useState('');
  const [babydob, setBabydob] = useState('');
  const [refercode, setRefercode] = useState('');


  const send_data = {
    "name": name,
    "mobile": mobile,
    "email": email,
    "password": password,
    "baby_name": babyname,
    "baby_dob": babydob,
    "refer_code": refercode
  }
  const saveAccount = async () => {
    try {
      const response = await axios({
        method: "POST",
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/save-account-web-bo.php",
        data: send_data
      });
      console.log(response, 'hulu');
      if (response.data.response == 1) {
        // alert(response.data.msg);
        Router.push('/verifyOtp');
      }
    } catch (err) {
      console.log(err);
    }
  }; 
  
  const checkLoggedIn = () => {
    const useNme = localStorage.getItem('name');
    const useId = localStorage.getItem('user_id');
    if (useNme != null && useId != null) {
      Router.push('/');
    }
    
  }

  useEffect(() => {
    checkLoggedIn();
}, []);

  return (
    <div>
      <div className="signup">
        <div className="container">
          <div className="row justify-content-center text-start mt-2 mt-lg-3  mb-0 mb-lg-2">
            <div className="col-12 col-md-5 col-lg-5">
              <div className="signup_title">
                <h1>Register</h1>
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
                      placeholder="Enter Name"
                      value={name}
                      onChange={(e) => setName(e.target.value)}
                    />
                  </Form.Group>
                  <Form.Group className="mb-3" controlId="formBasicEmail">
                    <Form.Label className="form_label">
                      Mobile Number
                    </Form.Label>
                    <Form.Control
                      className="form_control_group w-100"
                      type="name"
                      placeholder="Enter Mobile Number"
                      value={mobile}
                      onChange={(e) => setMobile(e.target.value)}
                    />
                  </Form.Group>
                  <Form.Group className="mb-3" controlId="formBasicEmail">
                    <Form.Label className="form_label">Baby Name</Form.Label>
                    <Form.Control
                      className="form_control_group w-100"
                      type="name"
                      placeholder="Enter Baby Name"
                      value={babyname}
                      onChange={(e) => setBabyname(e.target.value)}
                    />
                  </Form.Group>
                  <Form.Group className="mb-3" controlId="formBasicEmail">
                    <Form.Label className="form_label">
                      Baby Date Of Birth
                    </Form.Label>
                    <Form.Control
                      className="form_control_group w-100"
                      type="name"
                      placeholder="Enter Date Of Birth"
                      value={babydob}
                      onChange={(e) => setBabydob(e.target.value)}
                    />
                  </Form.Group>
                  <Form.Group className="mb-3" controlId="formBasicEmail">
                    <Form.Label className="form_label">Email</Form.Label>
                    <Form.Control
                      className="form_control_group w-100"
                      type="email"
                      placeholder="Enter Email"
                      value={email}
                      onChange={(e) => setEmail(e.target.value)}
                    />
                  </Form.Group>

                  <Form.Group className="mb-3" controlId="formBasicPassword">
                    <Form.Label className="form_label">Password</Form.Label>
                    <Form.Control
                      className="form_control_group w-100"
                      type="password"
                      placeholder="Password"
                      value={password}
                      onChange={(e) => setPassword(e.target.value)}
                    />
                  </Form.Group>
                  <Form.Group className="mb-3" controlId="formBasicPassword">
                    <Form.Label className="form_label">
                      Referral Code
                    </Form.Label>
                    <Form.Control
                      className="form_control_group w-100"
                      type="password"
                      placeholder="Enter Referral Code"
                      value={refercode}
                      onChange={(e) => setRefercode(e.target.value)}
                    />
                  </Form.Group>

                  <Button
                    className="signup_button w-100 mb-2 mb-lg-5"
                    // type="submit"
                    onClick={() => saveAccount()}
                  >
                    Sign Up
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

export default Register;
