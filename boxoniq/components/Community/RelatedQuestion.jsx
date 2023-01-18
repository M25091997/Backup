import React, { useEffect, useState } from "react";
import axios from "axios";
import Router from 'next/router';

const RelatedQuestion = () => {
  const [questions, setQuestions] = useState([]);

  const communityQues = () => {
    axios
      .get(
        "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/get-community-questions.php"
      )
      .then((response) => {
        // console.log(response.data, 'lulu');
        setQuestions(response.data);
      })
      .catch((err) => {
        console.log(err);
      });
  };

  const goToAns = (qid) => {
    Router.push('../communityUpdate/'+qid);
  }

  useEffect(() => {
    communityQues();
  }, []);
  return (
    <>
          {questions && questions.length > 0 ? questions.map((item) => {
            return (
              <button onClick={() => goToAns(item.question_id)} key={item.question_id} className="btn w-100 text-start rounded bg-white py-2 my-3">
                      {item.question}
             </button>
            )
          }) : ""}
         
    </>
  )
}

export default RelatedQuestion