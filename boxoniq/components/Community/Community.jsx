import Link from "next/link";
import React, { useEffect, useState } from "react";
import axios from "axios";


const Community = () => {
  const [count, setCount] = useState('');
  const communityQues = () => {
    axios
      .get(
        "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/get-community-question-count-bo.php"
      )
      .then((response) => {
        // console.log(response.data, 'lulu');
        setCount(response.data.ques_count);
      })
      .catch((err) => {
        console.log(err);
      });
  };
  useEffect(() => {
    communityQues();
    // fetch("questionData.json")
    //   .then((res) => res.json())
    //   .then((data) => setQuestions(data));
  }, []);
  return (
    <section className="section-container">
      <div className="container">
        <h1 className="text-center community-name py-lg-5 ">Community</h1>
        <h4 className="community-title">
          Bulding network for the smartest Parents
        </h4>
        <p className="community-des">
          It is a long established fact that a reader will distracted by the
          readable content of a page when looking at its layout. The point of
          usingLorem Ipsum is that it has a more-or-less normal distribution of
          letters, as opposed tousing Content here, content here, making itlook
          like readable English.
        </p>
        <div className="d-flex justify-content-start align-items-center gap-3 my-5">
          <p className="fw-bold pt-3 quesiton-title ">{count} Questions Asked</p>
          <Link href="/communityQna">
            <button
              style={{ backgroundColor: "#09A42B" }}
              className="btn text-white community-btn"
            >
              Get Started
            </button>
          </Link>
        </div>
        <div className="row mx-0">
          <div className="col-12 col-md-5 mb-5">
            <div className="p-5 left rounded rounded-5 bg-white mb-5">
              <div className="w-100">
                <img
                  className="d-block w-100 mx-auto"
                  src="https://i.ibb.co/k376cLF/undraw-mobile-interface-re-1vv9-1.png"
                  alt=""
                />
                <h3 className="feature-title text-center my-2">Features</h3>
                <p className="feature-para text-center mb-2">
                  Boxoniq community keeps you on top of everything happening in
                  your community
                </p>
              </div>
            </div>
            <div className="p-5 rounded rounded-5 info-sec my-5">
              <div className="w-100">
                <img
                  className="d-block w-100 mx-auto"
                  src="https://i.ibb.co/XCtWDGd/undraw-events-re-98ue-1.png"
                  alt=""
                />
                <h3 className="share-title text-center text-white my-4">
                  Share topics & events
                </h3>
                <p className="share-para text-center text-white mb-5">
                  Boxoniq community keeps you on top of everything happening in
                  your community
                </p>
              </div>
            </div>
          </div>
          <div className="col-12 col-md-5 mb-4">
            <div className="p-5 rounded rounded-5 info-sec">
              <div className="w-100">
                <img
                  className="d-block w-100 mx-auto"
                  src="https://i.ibb.co/6v7WN27/undraw-information-tab-re-f0w3-1.png"
                  alt=""
                />
                <h1 className="information-title text-center text-white my-4">
                  Get information
                </h1>
                <p className="information-para text-center text-white mb-5 py-4">
                  Boxoniq community keeps you on top of everything happening in
                  your community
                </p>
              </div>
            </div>
            <div className="p-5  rounded rounded-5 bg-white community-building">
              <div className="w-100">
                <img
                  className="d-block w-100 mx-auto"
                  src="https://i.ibb.co/CQMmXv6/undraw-community-re-cyrm-1.png"
                  alt=""
                />
                <h3 className="build-community-title text-center my-1 ">
                  Build community
                </h3>
                <p className="build-community-para text-center ">
                  Boxoniq community keeps you on top of everything happening in
                  your community
                </p>
              </div>
            </div>
          </div>
        </div>
        <Link href="/communityQna">
          <button
            style={{ backgroundColor: "#09A42B" }}
            className="btn text-white community-get-start-btn"
          >
            Get Started
          </button>
        </Link>
      </div>
    </section>
  );
};

export default Community;
