import React from 'react'

const Topsectiondata = (props) => {
    const bundle = props.x;
  return (
      <div className="row">
          <div className="col-3 col-lg-2">
              <div className="check_des_area">
                  <img src="/images/babyfour.png" alt="" />
              </div>
          </div>
          <div className="col-9 col-lg-10">
              <div className="chek_text">
                  <h4>{bundle.name}</h4>
                  <p>
                      {bundle.desc}
                  </p>
              </div>
          </div>
      </div>
  )
}

export default Topsectiondata