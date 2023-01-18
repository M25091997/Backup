import React from 'react'
import Shim from '../Shim'

const CommunityQuesShim = () => {
  return (
    <div
              className="card p-2 p-lg-0 popular-container mb-3"
              style={{cursor:'pointer'}}
            >
              <div className="p-2 question-container">
                    <Shim height={'200px'} width={'250px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3 '} />
                <div className="question_area__avatar">
                  <div className="question-details">
                    <h3>
                        <Shim height={'35px'} width={'400px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3 '} />
                    </h3>
                   
                    <p className="answers">
                        <Shim height={'20px'} width={'500px'} top={'5px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3 '} />
                        <Shim height={'20px'} width={'400px'} top={'5px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3 '} />
                        <Shim height={'20px'} width={'300px'} top={'5px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3 '} />
                        <Shim height={'20px'} width={'200px'} top={'5px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3 '} />
                    </p>
                  </div>
                </div>
              </div>
            </div>
  )
}

export default CommunityQuesShim