import React from 'react'
import Shim from '../../Shim'

const StoryShim = () => {
  return (
    <div className="row">
      <div className="col-lg-11 col-sm-10 mx-auto">
        <div className="container-fluid stories-details ">
          <div className="row">
            <div className="col-lg-5 col-sm-4">
              <div className="stories-img">
                <Shim height={'200px'} width={'250px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3 '} />
              </div>
            </div>
            <div className="col-lg-5 col-sm-4">
              <div className="stories-content-details mx-auto">
                <h3>
                  <Shim height={'35px'} width={'400px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3 '} />
                  </h3>
                <p>
                  <Shim height={'20px'} width={'500px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3 '} />
                  <Shim height={'20px'} width={'400px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3 '} />
                  <Shim height={'20px'} width={'300px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3 '} />
                  <Shim height={'20px'} width={'200px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3 '} />
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  )
}

export default StoryShim