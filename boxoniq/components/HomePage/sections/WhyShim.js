import React from 'react'
import Shim from '../../Shim';


const WhyShim = () => {
  return (
      <div style={{marginRight:"30px"}} className="col-6 col-sm-4 col-lg-2">
          <Shim height={'180px'} width={'240px'} border={'4px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3'} />

          <h3 className="baby-title text-center my-4">
              <Shim height={'20px'} width={'240px'} border={'4px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3'} />
              <Shim height={'20px'} width={'240px'} border={'4px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3'} />
          </h3>
      </div>
  )
}

export default WhyShim