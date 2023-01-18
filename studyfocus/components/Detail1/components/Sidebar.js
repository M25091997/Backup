import React from 'react'
import { useDispatch, useSelector } from 'react-redux';
// import { getSingleTutor } from '../../../redux/actions';
import { generatePublicUrl } from '../../../helpers/urlConfig';
import StudentInfo from '../../StudentInfo';


export const Sidebar = () => {
    const singleTutor = useSelector(state => state.singleTutorData);
    return (
        <>
            <div className="course__sidebar pl-70 p-relative">
                {/* <div className="course__shape">
                    <img className="course-dot" src="assets/img/course/course-dot.png" alt="" />
                </div> */}
                <div className="course__sidebar-widget-2 white-bg mb-20">
                    {
                        singleTutor.singletutor.tutors && singleTutor.singletutor.tutors.length > 0 ? singleTutor.singletutor.tutors.map(tutor =>
                            <>
                                <div className="course__video">
                                    <div className="course__video-thumb w-img mb-25">
                                        <img src="/assets/img/course/video/course-video.jpg" alt="" />
                                        <div className="course__video-play">
                                            <a href="https://youtu.be/yJg-Y5byMMw" data-fancybox="" className="play-btn"> <i className="fas fa-play"></i> </a>
                                        </div>
                                    </div>
                                    {/* <div className="course__video-meta mb-25 d-flex align-items-center justify-content-between">
                            <div className="course__video-price">
                                <h5>$74.<span>00</span> </h5>
                                <h5 className="old-price">$129.00</h5>
                            </div>
                            <div className="course__video-discount">
                                <span>68% OFF</span>
                            </div>
                        </div> */}

                                    <div className="course__video-content mb-35">
                                        <ul>

                                            <li className="d-flex align-items-center">
                                                <div className="course__video-icon">

                                                </div>
                                                <div className="course__video-info">
                                                    <h5><span>Name :</span> {tutor.name + tutor.l_name}</h5>
                                                </div>
                                            </li>
                                            <li className="d-flex align-items-center">
                                                <div className="course__video-icon">

                                                </div>
                                                <div className="course__video-info">
                                                    <h5><span>Classes :</span>{tutor.class}</h5>
                                                </div>
                                            </li>
                                            <li className="d-flex align-items-center">
                                                <div className="course__video-icon">

                                                </div>
                                                <div className="course__video-info">
                                                    <h5><span>Subjects :</span>{tutor.subjects}</h5>
                                                </div>
                                            </li>
                                            <li className="d-flex align-items-center">
                                                <div className="course__video-icon">

                                                </div>
                                                <div className="course__video-info">
                                                    <h5><span>Board :</span>{tutor.board}</h5>
                                                </div>
                                            </li>
                                            <li className="d-flex align-items-center">
                                                <div className="course__video-icon">

                                                </div>
                                                <div className="course__video-info">
                                                    <h5><span>Medium :</span>{tutor.medium}</h5>
                                                </div>
                                            </li>
                                            <li className="d-flex align-items-center">
                                                <div className="course__video-icon">

                                                </div>
                                                <div className="course__video-info">
                                                    <h5><span>Platform :</span>{tutor.platform}</h5>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                    <div className="course__payment mb-35">
                                        <h3>Payment:</h3>
                                        <a href="#">
                                            <img src="/assets/img/course/payment/payment-1.png" alt="" />
                                        </a>
                                    </div>
                                    <div className="course__enroll-btn">
                                        <StudentInfo />
                                    </div>
                                </div>
                            </>
                        ) : ""
                    }
                </div>
                <div className="course__sidebar-widget-2 white-bg mb-20">
                    <div className="course__sidebar-course">
                        <h3 className="course__sidebar-title">Related Subjects</h3>
                        <ul>
                            {
                                singleTutor.singletutor.related_subjects && singleTutor.singletutor.related_subjects.length > 0 ? singleTutor.singletutor.related_subjects.map(subject =>
                                    <>
                                        <li>
                                            <div className="course__sm d-flex align-items-center mb-30">
                                                <div className="course__sm-thumb mr-20">
                                                    <a href="#">
                                                        <img src={generatePublicUrl('subjects/' + subject.img)} alt="" />
                                                    </a>
                                                </div>
                                                <div className="course__sm-content">
                                                    <div className="course__sm-rating">
                                                        <ul>
                                                            <li><a href="#"> <i className="icon_star"></i> </a></li>
                                                            <li><a href="#"> <i className="icon_star"></i> </a></li>
                                                            <li><a href="#"> <i className="icon_star"></i> </a></li>
                                                            <li><a href="#"> <i className="icon_star"></i> </a></li>
                                                            <li><a href="#"> <i className="icon_star"></i> </a></li>
                                                        </ul>
                                                    </div>
                                                    <h5><a href="#">{subject.subject_name}</a></h5>
                                                    {/* <div className="course__sm-price">
                                                        <span>$54.00</span>
                                                    </div> */}
                                                </div>
                                            </div>
                                        </li>
                                    </>
                                ) : ""
                            }
                        </ul>
                    </div>
                </div>
            </div>
        </>
    )
}
