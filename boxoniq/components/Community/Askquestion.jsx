import React, { useState, useEffect } from 'react'
import axios from 'axios';

const Askquestion = () => {
    const [question, setQuestion] = useState('');
    const send_data = {
        "account_id": 2,
        "question": question
    }
    const sendQues = async () => {
        try {
            const response = await axios({
                method: "POST",
                url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/add-community-question-web.php",
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

  return (
      <div className="community-box d-flex flex-column flex-md-row justify-content-center align-items-center half-width  mx-auto bg-white rounded my-5 ask-form">
          <div className="w-25">
              <img
                  className="p-3"
                  src="https://i.ibb.co/xDKrjKV/conversation.png"
                  alt=""
              />
          </div>
          {/* <form className="w-75 "> */}
              <input
                  type="text"
                  className="input-bottom text"
                  placeholder="Ask and discuss everything here..."
                  value={question}
                  onChange={(e) => setQuestion(e.target.value)}
              />
              <button
                  style={{ backgroundColor: "#09A42B" }}
                  className="btn btn-success ask-button "
                  onClick={() => sendQues()}
              >
                  Post
              </button>
          {/* </form> */}
      </div>
  )
}

export default Askquestion