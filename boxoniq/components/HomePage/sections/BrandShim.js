import React from 'react'
import Shim from '../../Shim';


const BrandShim = () => {
  return (
      <div style={{marginRight:"10px"}} className="col-6 col-sm-4 col-lg-2">
          <Shim height={'100px'} width={'200px'} radius={'20%'} border={'4px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3'} />
      </div>
  )
}

export default BrandShim