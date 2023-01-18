import React from 'react'
// import { Video } from './Video'


export const Sidebar = () => {
    return (
        <>
            <div className="course__sidebar pl-70 p-relative">
                <div className="course__shape">
                    <img className="course-dot" src="assets/img/course/course-dot.png" alt="" />
                </div>
                <div className="course__sidebar-widget-2 white-bg mb-20">
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
                                        <h5><span>Instructor :</span> Eleanor Fant</h5>
                                    </div>
                                </li>
                                <li className="d-flex align-items-center">
                                    <div className="course__video-icon">

                                    </div>
                                    <div className="course__video-info">
                                        <h5><span>Lectures :</span>14</h5>
                                    </div>
                                </li>
                                <li className="d-flex align-items-center">
                                    <div className="course__video-icon">

                                    </div>
                                    <div className="course__video-info">
                                        <h5><span>Duration :</span>6 weeks</h5>
                                    </div>
                                </li>
                                <li className="d-flex align-items-center">
                                    <div className="course__video-icon">

                                    </div>
                                    <div className="course__video-info">
                                        <h5><span>Enrolled :</span>20 students</h5>
                                    </div>
                                </li>
                                <li className="d-flex align-items-center">
                                    <div className="course__video-icon">

                                    </div>
                                    <div className="course__video-info">
                                        <h5><span>Language :</span>English</h5>
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
                            <a href="contact.html" className="e-btn e-btn-7 w-100">Contact Me <i className="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div className="course__sidebar-widget-2 white-bg mb-20">
                    <div className="course__sidebar-course">
                        <h3 className="course__sidebar-title">Related Subjects</h3>
                        <ul>
                            <li>
                                <div className="course__sm d-flex align-items-center mb-30">
                                    <div className="course__sm-thumb mr-20">
                                        <a href="#">
                                            <img src="/assets/img/course/sm/course-sm-1.jpg" alt="" />
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
                                        <h5><a href="#">Development</a></h5>
                                        <div className="course__sm-price">
                                            <span>$54.00</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div className="course__sm d-flex align-items-center mb-30">
                                    <div className="course__sm-thumb mr-20">
                                        <a href="#">
                                            <img src="/assets/img/course/sm/course-sm-2.jpg" alt="" />
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
                                        <h5><a href="#">Data Science</a></h5>
                                        <div className="course__sm-price">
                                            <span>$72.00</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div className="course__sm d-flex align-items-center mb-10">
                                    <div className="course__sm-thumb mr-20">
                                        <a href="#">
                                            <img src="/assets/img/course/sm/course-sm-3.jpg" alt="" />
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
                                        <h5><a href="#">UX Design</a></h5>
                                        <div className="course__sm-price">
                                            <span>Free</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </>
    )
}
