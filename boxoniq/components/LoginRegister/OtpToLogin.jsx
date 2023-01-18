import React, { useState, useEffect } from 'react'
import axios from 'axios';

import Button from "react-bootstrap/Button";
import Form from "react-bootstrap/Form";
import Link from "next/link";
import Router from 'next/router';

const OtpToLogin = () => {
  const [otp, setOtp] = useState('');
  const [userid, setUserid] = useState('');

  const getAccount = () => {
    const account_id = localStorage.getItem('userId');
    setUserid(account_id);
  }
  const send_data = {
    "otp": otp,
    "account_id": userid
  }
  const sendOtp = async () => {
    try {
      const response = await axios({
        method: "POST",
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/login-with-otp.php",
        data: send_data
      });
      // console.log(response, 'hulu');
      if (response.data.response == 1) {
        localStorage.setItem('user_id', response.data.accountId);
        localStorage.setItem('name', response.data.name);
        localStorage.setItem('email', response.data.email);
        localStorage.setItem('phone', response.data.phone);
        // alert(response.data.msg);
        Router.push('/');
      }
    } catch (err) {
      console.log(err);
    }
  };

  useEffect(() => {
    getAccount();
  }, []);

  return (
    <div>
      <div className="signup">
        <div className="container">
          <div className="row justify-content-center text-start mt-0 mt-lg-3 mb-0 mb-lg-4 ">
            <div className="col-12 col-md-6 col-lg-6">
              <div className="signup_title">
                <h1>Login with OTP</h1>
              </div>
            </div>
          </div>
          <div className="row justify-content-center text-start mb-3  mt-lg-2 mb-lg-3 ">
            <div className="col-12 col-md-6 col-lg-6">
              <div className="login_title">
                <h4>Hello there,enter otp to login in your account</h4>
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
                    onClick={() => sendOtp()}
                  >
                    Enter OTP
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

export default OtpToLogin;
