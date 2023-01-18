import React, { useState, useEffect } from 'react'
import axios from 'axios';

import Button from "react-bootstrap/Button";
import Form from "react-bootstrap/Form";
import Link from "next/link";
import Router from "next/router";

const VerifyOtp = () => {
  const [otp, setOtp] = useState('');
  const send_data = {
    "user_id": 1,
    "otp": otp
  }
  const verOtp = async () => {
    try {
      const response = await axios({
        method: "POST",
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/verify-otp-bo.php",
        data: send_data
      });
      // console.log(response, 'hulu');
      if (response.data.response == 1) {
        // alert(response.data.msg);
        Router.push('/');
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
          <div className="row justify-content-center text-start mt-0 mt-lg-3 mb-0 mb-lg-4 ">
            <div className="col-12 col-md-6 col-lg-6">
              <div className="signup_title">
                <h1>Verify mobile no</h1>
              </div>
            </div>
          </div>
          <div className="row justify-content-center text-start mb-3  mt-lg-2 mb-lg-3 ">
            <div className="col-12 col-md-6 col-lg-6">
              <div className="login_title">
                <h4>Hello there,enter otp to verify your mobile no</h4>
              </div>
            </div>
          </div>
          <div className="row justify-content-center text-start">
            <div className="col-12 col-md-6 col-lg-6">
              <div className="signup_form">
                <Form>
                  <Form.Group className="mb-3" controlId="formBasicEmail">
                    <Form.Label className="form_label">Otp</Form.Label>
                    <Form.Control
                      className="form_control_group w-100"
                      type="text"
                      placeholder="Enter OTP"
                      value={otp}
                      onChange={(e) => setOtp(e.target.value)}
                    />
                  </Form.Group>

                  <Button
                    className="signup_button w-100 mb-2 mb-lg-2"
                    // type="submit"
                    onClick={() => verOtp()}
                  >
                    Verify OTP
                  </Button>
                  {/* <Link href="register">
                    <Button
                      className="signup_button_link w-100 mb-2 "
                      type="submit"
                    >
                      Sign Up
                    </Button>
                  </Link> */}
                </Form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default VerifyOtp;
