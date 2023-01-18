import React, { useState, useEffect } from 'react'
import axios from 'axios';


const Contact = () => {
    const [email, setEmail] = useState('');
    const send_data = {
        "user_id" :1,
        "email": email
    }
    const sendEmail = async () => {
        try {
            const response = await axios({
                method: "POST",
                url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/add-home-email.php",
                data: send_data
            });
            console.log(response, 'hulu');
            if(response.data.response == 1){
                alert(response.data.msg);
            }
        } catch (err) {
            console.log(err);
        }
    }; 

  return (
      <section className="contact-section">
          <h1 className="contact-title">Let&apos;s Stay In Touch</h1>
          <p className="contact-short-title">
              Get access to latest updates from boxoniq and special offers
          </p>
          <div className="">
              <input
                  className="input-text"
                  type="email"
                  name=""
                  id=""
                  placeholder="Enter your email address"
                  value={email}
                  onChange={(e) => setEmail(e.target.value)}
              />
              <button
                  className="input-submit"
                  type="submit"
                  onClick={() => sendEmail()}
              >Submit</button>
          </div>
      </section>
  )
}

export default Contact