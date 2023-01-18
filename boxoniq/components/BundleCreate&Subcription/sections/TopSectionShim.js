import React from 'react'
import Shim from '../../Shim';

const TopSectionShim = () => {
  return (
      <div className="row">
          <div className="col-3 col-lg-2">
              <div className="check_des_area">
                  <Shim height={'150px'} width={'150px'} radius={'50%'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3'} />
              </div>
          </div>
          <div className="col-9 col-lg-10">
              <div className="chek_text">
                  <h4>
                      <Shim height={'50px'} width={'200px'} border={'1px gray'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3'} />

                  </h4>
                  <p>
                      <Shim height={'20px'} width={'800px'} border={'1px gray'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3'} />
                      <Shim height={'20px'} width={'800px'} border={'1px gray'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3'} />
                      <Shim height={'20px'} width={'800px'} border={'1px gray'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3'} />
                  </p>
              </div>
          </div>
      </div>
  )
}

export default TopSectionShim