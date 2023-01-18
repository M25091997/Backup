import React from 'react'
import Shim from '../../Shim';


const BundleShim = () => {
  return (
      <div className="shape shadow">
          <div className="shape-title">
              <p>
                  <Shim height={'15px'} width={'350px'} border={'4px'} radius={'10%'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3'} />

              </p>
              <p className="shape_title_sec d-block">
                  <Shim height={'25px'} width={'350px'} border={'4px'} radius={'10%'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3'} />
              </p>
          </div>

          <div className="banifit-box">
              <Shim height={'150px'} width={'150px'} radius={'50%'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3'} />

          </div>
      </div>
  )
}

export default BundleShim