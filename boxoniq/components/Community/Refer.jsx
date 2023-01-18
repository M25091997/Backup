import React, { useEffect, useState } from "react";

const Refer = () => {
  const [answer, setAnswer] = useState([]);
  console.log(answer);
  useEffect(() => {
    fetch("answerData.json")
      .then((res) => res.json())
      .then((data) => setAnswer(data));
  }, []);
  return (
    <section className="earn">
      <div className="earn-container position-relative">
        <div className="earn-bg"></div>
        <div className="earn-content">
          <div className="container-fluid">
            <div className="row">
              <div className="col-lg-12">
                <div className="earn-title text-center py-lg-5">
                  <h1>Refer and Earn</h1>
                </div>
              </div>
            </div>
            <div className="row justify-content-center align-items-center">
              <div className="col-lg-7">
                <div className="earn-box">
                  <div className="row">
                    <div className="col-lg-6">
                      <div className="earn-content">
                        <h5>Refer and Earn (Invite)</h5>
                        <p>
                          Invite friends & earn flat 50 in your boxoniq wallet,
                          on thein first purchase.
                        </p>
                        <div className="earn-btn mb-3">
                          <button className="btn btn-earn w-100 my-2">
                            Invite Contact
                          </button>
                        </div>
                        <span className="or text-center">
                          <h3>Or</h3>
                        </span>
                        <div className="input-group flex-nowrap mt-4">
                          <input
                            type="text"
                            className="form-control code-control text-center"
                            placeholder="Use your code"
                            aria-label="Username"
                            aria-describedby="addon-wrapping"
                          />
                          <span
                            className="input-group-text-copy"
                            id="addon-wrapping"
                          >
                            Copy
                          </span>
                        </div>
                      </div>
                    </div>
                    <div className="col-lg-6">
                      <div className="refer-img">
                        <img
                          className="img-fluid"
                          src="https://i.ibb.co/cC5N2wc/image-removebg-preview-6-1.png"
                          alt=""
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
};

export default Refer;
