import React from 'react'

const Qualification = (props) => {
    return (
        <div className="card tutor-detail-card" >
            <div className="card-body">
                <div className="row">
                    <div className="col-md-3 col-xl-3">
                        <img style={{ marginLeft: '20%', height: '70px', borderRadius: '23px' }} src="/assets/tutor/university.png" alt="" />
                    </div>
                    <div className="col-md-9 col-xl-9">
                        <h4>{props.qual.qualification} From {props.qual.university}</h4>
                        <p style={{ color: '#949494' }}>{props.qual.place}, {props.qual.year_from}</p>
                    </div>
                </div>
            </div>
        </div>
    )
}

export default Qualification;
