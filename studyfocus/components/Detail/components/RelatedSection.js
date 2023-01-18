import React from 'react'

export const RelatedSection = () => {
    const renderSubArray = (sub) => {
        const myArray = sub.split(",");
        return myArray;
    }
    return (
        <>
            <div className="course__related">
                <div className="row">
                    <div className="col-xxl-12">
                        <div className="card">
                            
                            <div className="card-body"
                                // style={{
                                //     backgroundImage: 'url("/assets/img/course/teacher/teacher-1.jpg")',
                                // }}
                            >
                                <div className="row">
                                    <div className="col-md-3 col-xl-3">
                                        <img style={{ height: '171px', borderRadius: '23px' }} src="/assets/img/course/teacher/teacher-1.jpg" alt="" />
                                    </div>
                                    <div className="col-md-9 col-xl-9">
                                        <h4>Featured Tutors</h4>
                                        <h3>Jethalal Champaklal Gada</h3>
                                        <p>Mumbai, Maharashtra</p>
                                        <button className="btn btn-primary">Enquire Now</button>

                                    </div>
                                </div>
                                <div>
                                </div>
                            </div>

                        </div>

                        <div className="card">
                            <div className="card-body">
                                <div className="row">
                                    <div className="col-md-3 col-xl-3">
                                        <img style={{ height: '100px', borderRadius: '23px' }} src="/assets/tutor/experiment.png" alt="" />
                                    </div>
                                    <div className="col-md-9 col-xl-9">
                                        <p>SUBJECTS OFFERED</p>
                                        {

                                            renderSubArray(tutor.subjects).length > 0 ?
                                                renderSubArray(tutor.subjects).slice(0, 2).map(i =>
                                                    <span className="badge bg-warning text-center" style={{ fontSize: '10px', marginRight: '3px', backgroundColor: '#4762a7' }}>{i.substring(0, 5) + '...'}</span>
                                                ) : null
                                        }
                                    </div>
                                </div>

                                <div className="row">
                                    <div className="col-md-3 col-xl-3">
                                        <img style={{ height: '100px', borderRadius: '23px' }} src="/assets/tutor/rating.png" alt="" />
                                    </div>
                                    <div className="col-md-9 col-xl-9">
                                        <p>REVIEW & RATINGS</p>
                                        <div className="course__rating-2 mb-30">
                                            <div className="course__rating-inner d-flex align-items-center">
                                                <ul>
                                                    <li><a href="#"> <i className="icon_star"></i> </a></li>
                                                    <li><a href="#"> <i className="icon_star"></i> </a></li>
                                                    <li><a href="#"> <i className="icon_star"></i> </a></li>
                                                    <li><a href="#"> <i className="icon_star"></i> </a></li>
                                                    <li><a href="#"> <i className="icon_star"></i> </a></li>
                                                </ul>
                                                <p>4.5</p>
                                            </div>
                                        </div>
                                        <button className="btn btn-primary">Enquire Now</button>
                                    </div>
                                </div>

                            <div>
                        </div>
                    </div>

                        </div>
                        
                    </div>
                </div>
            </div>
        </>
    )
}
