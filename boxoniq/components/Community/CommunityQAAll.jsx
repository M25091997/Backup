import React, { useEffect, useState } from "react";
import Link from "next/link";
import Seemorelinks from "./Seemorelinks";
import Searchcommunityquestion from "./Searchcommunityquestion";
import CommunityQuesShim from "./CommunityQuesShim";

// import Askquestion from "./Askquestion";
import axios from "axios";
import Router from 'next/router';


const CommunityQA = () => {
  const [questions, setQuestions] = useState([]);
  const [question, setQuestion] = useState('');
  const [search, setSearch] = useState('');


  const searchQues = async (sea) => {
    const send_data = {
      "search": sea
    }
    if(sea.length>2){
      try {
        const response = await axios({
          method: "POST",
          url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/get-community-search-questions-web.php",
          data: send_data
        });
        // console.log(response, 'hulu');
        if (response.data != "") {
          setQuestions(response.data);
        }
      } catch (err) {
        console.log(err);
      }
    }else{
      communityQues();
    }
   
  }; 
 
  const sendQues = async () => {
    const useNme = localStorage.getItem('name');
    const useId = localStorage.getItem('user_id');
    if (useNme == null || useId == null) {
      Router.push('../login');
      return;
    }else{
      const send_data = {
        "account_id": useId,
        "question": question
      }
      try {
        const response = await axios({
          method: "POST",
          url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/add-community-question-web.php",
          data: send_data
        });
        // console.log(response, 'hulu');
        if (response.data.response == 1) {
          alert(response.data.msg);
          communityQues();
        }
      } catch (err) {
        console.log(err);
      }
    }
    
    
  }; 

  const goToAnswer = (blogId) => {
    Router.push("communityUpdate/" + blogId);

  }
  const communityQues = () => {
    axios
      .get(
        "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/get-community-questions.php"
      )
      .then((response) => {
        console.log(response.data, 'lulu');
        setQuestions(response.data);
      })
      .catch((err) => {
        console.log(err);
      });
  };
  console.log(questions);
  useEffect(() => {
    communityQues();
    // fetch("questionData.json")
    //   .then((res) => res.json())
    //   .then((data) => setQuestions(data));
  }, []);
  return (
    <section className="section-container">
      {/* Community banner arra */}
      <div className="community-container">
        <h1 className="text-center pt-lg-5 pb-2 text-white">Community</h1>
        {/* <Searchcommunityquestion/> */}
        <form className="half d-flex  justify-content-center">
          <input
            type="text"
            style={{ backgroundColor: "#D9D9D9" }}
            className="form-control community p-3  ps-5 rounded"
            placeholder="Search for answers, topics..."
            value={search}
            onChange={(e) =>{ setSearch(e.target.value); searchQues(search);}}
          />
          <img
            className="community-img"
            src="https://i.ibb.co/WG0n2t0/search-6-1-1.png"
            alt=""
          />
        </form>
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
        {/* <Askquestion/> */}
      </div>

      {/* Community Q&A area */}
      <section
        style={{ paddingTop: "100px" }}
        className="row container mx-auto mx-0"
      >
        {/* Popular Question area */}
        <div className="col-12 col-md-8 col-lg-9">
          <h3 className="popular-question">Popular Questions</h3>
          {questions && questions.length > 0 ?questions.map((item) => (
            <div
              key={item.id}
              className="card p-2 p-lg-0 popular-container mb-3"
              onClick={() => goToAnswer(item.question_id)}
              style={{cursor:'pointer'}}
            >
              <div className="p-2 question-container">
                <img style={{height:'100px',width:'100px',borderRadius:'50%'}} src={item.img} alt="" />
                <div className="question_area__avatar">
                  <div className="question-details">
                    <h3>{item.user_name}</h3>
                    <p title={item.question}>
                      {item.question.slice(0, 50) + "..."}
                    </p>
                    <p className="answers">
                      {/* <span className="me-2">
                        <img
                          src={item.img}
                          alt=""
                        />
                      </span> */}
                      See Answers<b>- {item.answer_count}</b>
                    </p>
                  </div>
                  {/* <div className="image-collection">
                    {question?.avaterUser?.map((avater, i) => (
                      <img
                        key={i}
                        src={avater}
                        alt="Avatar"
                        className="avatar"
                      />
                    ))}

                    <div className="main-avatar">
                      <span className="avatar_two"></span>
                      <span className="avatar_two"></span>
                      <span className="avatar_two"></span>
                    </div>
                  </div> */}
                </div>
              </div>
            </div>
          )): 
          <><CommunityQuesShim/> <CommunityQuesShim/> <CommunityQuesShim/> <CommunityQuesShim/> </>
          }

        </div>

        {/* See moor area */}
        <div className="col-12 col-md-4 col-lg-3">
          <div className="see-more-div">
            <h3>See More</h3>
            <Seemorelinks/>
          </div>
        </div>
      </section>
    </section>
  );
};

export default CommunityQA;
