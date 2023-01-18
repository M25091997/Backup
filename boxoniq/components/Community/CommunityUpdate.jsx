import Link from "next/link";
import React, { useEffect, useState } from "react";
import RelatedQuestion from "./RelatedQuestion";
import axios from "axios";
import { useRouter } from 'next/router'
import Form from "react-bootstrap/Form";
import Router from 'next/router';
import Button from "react-bootstrap/Button";
import Modal from "react-bootstrap/Modal";

const CommunityUpdate = () => {
  const [answer, setAnswer] = useState([]);
  const [show, setShow] = useState(false);
  const [postanswer, setPostanswer] = useState('');
  const [ques, setQues] = useState('');



  const handleClose = () => setShow(false);
  const handleShow = () => setShow(true);

  const router = useRouter();
  const { qid } = router.query;
  // console.log(qid, 'nik');

  const postAnswer = async () => {
    const useNme = localStorage.getItem('name');
    const useId = localStorage.getItem('user_id');
    if (useNme == null || useId == null) {
      Router.push('../login');
      return;
    }
    const ques_data = {
      question_id: qid,
      account_id : useId,
      answer: postanswer
    }
    // console.log(ques_data, 'niks');
    // return;
    try {
      const response = await axios({
        method: "POST",
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/add-community-answer-web.php",
        data: ques_data
      });
      // console.log(response, 'niks');
      getAnsDetail(qid);
      setPostanswer('');
      setShow(false);
    } catch (err) {
      console.log(err);
    }
  };

  const getAnsDetail = async (qus_id) => {
    const ques_data = {
      question_id: qus_id
    }
    try {
      const response = await axios({
        method: "POST",
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/get-community-answers-web.php",
        data: ques_data
      });
      console.log(response, 'hulu');
      setAnswer(response.data.answer);
      setQues(response.data.question);
    } catch (err) {
      console.log(err);
    }
  };

  useEffect(() => {
    if (qid != undefined) {
      getAnsDetail(qid);
    }
  }, [qid]);
  // console.log(answer);
  // useEffect(() => {
  //   fetch("answerData.json")
  //     .then((res) => res.json())
  //     .then((data) => setAnswer(data));
  // }, []);
  return (
    <section className="section-container-update">
      {/* Community banner arra */}
      <div className="community-container-update container-fluid">
        <div className="row">
          <div className="col-lg-12">
            <div className="update-title">
              <h1 className="text-center text-white">
                {ques} ?
              </h1>
            </div>
            <div className="row">
              <div className="col-lg-12">
                <div className="button-div d-flex justify-content-center">
                  <button className="btn mt-3" onClick={handleShow}>Reply</button>
                </div>
              </div>
            </div>
            <Modal show={show} onHide={handleClose}>
              <Modal.Header closeButton>
                <Modal.Title className="answer_title">Answer</Modal.Title>
              </Modal.Header>
              <Modal.Body>
                <Form className="answer_form">
                  <Form.Group
                    className="mb-3 "
                    controlId="exampleForm.ControlInput1"
                  >
                    <Form.Control
                      className="answer_modal_input"
                      type="text"
                      placeholder="Write your answer here..."
                      value={postanswer}
                      onChange={(e) => setPostanswer(e.target.value)}
                    />
                  </Form.Group>
                </Form>
                <Button onClick={() => postAnswer()} className="next_button">Next</Button>
              </Modal.Body>
            </Modal>
          </div>
        </div>
      </div>

      {/* Community Q&A area */}
      <div className="container-fluid update-answers">
        <div className="row container update-container mx-auto mx-0">
          {/* Popular Answer area */}
          <div className="col-12 col-md-8 col-lg-9">
            <div className="update-answer">
              <h3>Answers</h3>
            </div>
            {answer && answer.length>0?answer.map((item) => (
              <div key={answer.id} className="card my-4">
                <div className="question-container">
                  <img src={item.img} alt="" style={{width:'100px', height:'100px', borderRadius:'50%'}}/>
                  <div className="update-details">
                    <h3>{item.user_name}</h3>
                    {/* <p>{item.created_on}</p> */}
                    <p className="update_para" title={item.id}>
                      {item.answer}
                    </p>
                  </div>
                  <div className="timer">
                    <p>{item.created_on}</p>
                  </div>
                </div>
              </div>
            )):""}
          </div>

          {/* See moor area */}
          <div className="col-12 col-md-4 col-lg-3">
            <div className="relate_question">
              <h3>Related Questions</h3>
              <RelatedQuestion/>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
};

export default CommunityUpdate;
