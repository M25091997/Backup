const Answer = () => {
  return (
    <section className="answer-feedback">
      <div className="container-fluid">
        <div className="row d-flex justify-content-center align-items-center mt-3 ">
          <div className="col-lg-5">
            <div className="answer-submit">
              <div className="row ">
                <div className="col-lg-12">
                  <div className="answers-div d-flex justify-content-between">
                    <div className="left-answer">
                      <h3>Answer</h3>
                    </div>
                    <div className="right-answer">
                      <button className="btn btn-none">
                        <img
                          className=""
                          src="https://i.ibb.co/QkFR8Hg/close-7-2.png"
                          alt=""
                        />
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <div className="row mt-4">
                <div className="col-lg-12">
                  <div className="text_area">
                    <textarea
                      className="form-control"
                      placeholder="Write your answer here..."
                      id="exampleFormControlTextarea1"
                      rows="8"
                    ></textarea>
                  </div>
                </div>
              </div>
              <div className="row justify-content-center mt-5">
                <div className="col-lg-12">
                  <div className="button_next_area">
                    <button className="btn w-100">Next</button>
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

export default Answer;
