import React from 'react'

const Review = (props) => {
    return (
        <div className="card tutor-detail-card" >
            <div className="card-body">
                <div className="row">
                    <div className="col-md-3 col-xl-3">
                        <img style={{ marginLeft: '20%', height: '70px', borderRadius: '23px' }} src="/assets/tutor/user.png" alt="" />
                    </div>
                    <div className="col-md-9 col-xl-9">
                        <h4>{props.rate.name}</h4>
                        <p style={{ color: '#949494' }}>{props.rate.review}</p>
                    </div>
                </div>
            </div>
        </div>
    )
}

export default Review;
