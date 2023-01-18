import React from 'react'
import Link from "next/link";


const Box = () => {
  return (
      <section className="box-container">
          <div className="row mx-0 justify-content-between align-items-center" style={{ marginTop: '36px'}}>
              <div className="col-12 col-md-3 box-left">
                  <img
                      className="box-position"
                      src="https://i.ibb.co/TRC52CX/Rectangle-94.png"
                      alt=""
                  />
                  <h1 className="box-title pt-5">
                      <span>HOW</span> IT WORKS
                  </h1>
              </div>
              <div className="col-12 col-md-5">
                  <div className="row">
                      <div className="col-md-4">
                          <center>
                              <div>
                                  <img src="https://i.ibb.co/rF690HB/Group-11.png" alt="" />
                              </div>
                              <h6 className=""><center>Create <br /> Box</center></h6>
                          </center>
                      </div>

                      <div className="col-md-4" style={{ paddingLeft: '50px' }}>
                          <center>
                              <div>
                                  <img src="https://i.ibb.co/TK4THkV/Group-12-2.png" alt="" />
                              </div>
                              <h6 className=""><center>Monthly <br /> Subscription</center></h6>
                          </center>
                      </div>

                      <div className="col-md-4" style={{ paddingLeft: '50px' }}>
                          <center>
                              <div>
                                  <img src="https://i.ibb.co/8BwhhRw/Group-10.png" alt="" />
                              </div>
                              <h6 className=""><center>Delivery <br /> Every Month</center></h6>
                          </center>
                      </div>
                  </div>
              </div>
              <div className="col-12 col-md-4">
                  <Link href="/bundleCreator">
                      <button style={{ backgroundColor: "#09A42B" }}>
                          Start Your Bundle
                          <img
                              className="ms-2 block-arrow"
                              src="https://i.ibb.co/GkmjLYb/Arrow-1.png"
                              alt=""
                          />
                      </button>
                  </Link>
              </div>
          </div>
      </section>
  )
}

export default Box