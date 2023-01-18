import React, { useState } from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { Share } from './Share';
import { Rating } from 'react-simple-star-rating';
import { generatePublicUrl, api } from '../../../helpers/urlConfig';
import axios from 'axios';


export const TabsSection = () => {
    const [rating, setRating] = useState(0);
    // Catch Rating value
    const handleRating = (rate) => {
        var user_id = localStorage.getItem('user_id');
        var tutor_id = localStorage.getItem('tutor_id');
        if (user_id == null) {
            alert('You need to Login First...');
            return false;
        } else {
            setRating(rate);
            const ratingData = {
                rating: rate, user_id: user_id, tutor_id: tutor_id
            }
            axios.post(`${api}/update/update-rating.php`, ratingData)
                .then(function (response) {
                    //handle success
                    alert(response.data.msg);
                    // console.log("success")
                })
                .catch(function (response) {
                    //handle error
                    console.log(response)
                    console.log("sorry")
                });
        }
    }
    const singleTutor = useSelector(state => state.singleTutorData);
    return (
        <>
            {
                singleTutor.singletutor.tutors && singleTutor.singletutor.tutors.length > 0 ? singleTutor.singletutor.tutors.map(tutor =>
                    <>
                        {localStorage.setItem('tutor_id', tutor.id)}
                        <div className="course__tab-2 mb-45">
                            <ul className="nav nav-tabs" id="courseTab" role="tablist">
                                <li className="nav-item" role="presentation">
                                    <button className="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true"> <i className="icon_ribbon_alt"></i> <span>Description</span> </button>
                                </li>
                                <li className="nav-item" role="presentation">
                                    <button className="nav-link " id="curriculum-tab" data-bs-toggle="tab" data-bs-target="#curriculum" type="button" role="tab" aria-controls="curriculum" aria-selected="false"> <i className="icon_book_alt"></i> <span>Qualification</span> </button>
                                </li>
                                <li className="nav-item" role="presentation">
                                    <button className="nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#review" type="button" role="tab" aria-controls="review" aria-selected="false"> <i className="icon_star_alt"></i> <span>Ratings</span> </button>
                                </li>
                                <li className="nav-item" role="presentation">
                                    <button className="nav-link" id="member-tab" data-bs-toggle="tab" data-bs-target="#member" type="button" role="tab" aria-controls="member" aria-selected="false"> <i className="fal fa-user"></i> <span>Members</span> </button>
                                </li>
                            </ul>
                        </div>
                        <div className="course__tab-content mb-95">
                            <div className="tab-content" id="courseTabContent">
                                <div className="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                                    <div className="course__description">
                                        <h3>Tutor Description</h3>
                                        <p><b>Description:</b> {tutor.descripion}</p><hr></hr>
                                        <p><b>Platform:</b> {tutor.platform}</p><hr></hr>
                                        <p><b>Qualification:</b> {tutor.qualification}</p><hr></hr>
                                        <p><b>Medium:</b> {tutor.medium}</p><hr></hr>
                                        <p><b>Board:</b> {tutor.board}</p><hr></hr>
                                        <div className="course__tag-2 mb-35 mt-35">
                                            <i className="fal fa-tag"></i>

                                            <a href="#">{tutor.subjects}</a>

                                        </div>
                                    </div>
                                </div>
                                <div className="tab-pane fade" id="curriculum" role="tabpanel" aria-labelledby="curriculum-tab">
                                    <div className="course__curriculum">
                                        <div className="accordion" id="course__accordion">
                                            <div className="accordion-item mb-50">
                                                <h2 className="accordion-header" id="week-01">
                                                    <button className="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#week-01-content" aria-expanded="true" aria-controls="week-01-content">
                                                        Qualification
                                                    </button>
                                                </h2>
                                                {
                                                    singleTutor.singletutor.qualification && singleTutor.singletutor.qualification.length > 0 ? singleTutor.singletutor.qualification.map(qual =>
                                                        <>
                                                            <div id="week-01-content" className="accordion-collapse collapse show" aria-labelledby="week-01" data-bs-parent="#course__accordion">
                                                                <div className="accordion-body">
                                                                    <div className="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                                                                        <div className="course__curriculum-info">

                                                                            <h3> <span>{qual.qualification}:</span> {qual.university}</h3>
                                                                        </div>
                                                                        <div className="course__curriculum-meta">
                                                                            <span className="time">{qual.year_from}</span>
                                                                            <span className="question">{qual.year_to}</span>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </>
                                                    ) : ""
                                                }
                                            </div>
                                        </div>
                                        {/* <div className="accordion" id="course__accordion-2">
                                            <div className="accordion-item mb-50">
                                                <h2 className="accordion-header" id="week-02">
                                                    <button className="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#week-02-content" aria-expanded="true" aria-controls="week-02-content">
                                                        Week 02
                                           </button>
                                                </h2>
                                                <div id="week-02-content" className="accordion-collapse  collapse show" aria-labelledby="week-02" data-bs-parent="#course__accordion-2">
                                                    <div className="accordion-body">
                                                        <div className="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                                                            <div className="course__curriculum-info">

                                                                <h3> <span>Reading:</span> Ut enim ad minim veniam</h3>
                                                            </div>
                                                            <div className="course__curriculum-meta">
                                                                <span className="time"> <i className="icon_clock_alt"></i> 14 minutes</span>
                                                            </div>
                                                        </div>
                                                        <div className="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                                                            <div className="course__curriculum-info">

                                                                <h3> <span>Video: </span> Greetings and introduction</h3>
                                                            </div>
                                                            <div className="course__curriculum-meta">
                                                                <span className="time"> <i className="icon_clock_alt"></i> 15 minutes</span>
                                                            </div>
                                                        </div>
                                                        <div className="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                                                            <div className="course__curriculum-info">

                                                                <h3> <span>Audio:</span> Interactive lesson</h3>
                                                            </div>
                                                            <div className="course__curriculum-meta">
                                                                <span className="time"> <i className="icon_clock_alt"></i> 7 minutes</span>
                                                                <span className="question">2 questions</span>
                                                            </div>
                                                        </div>
                                                        <div className="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                                                            <div className="course__curriculum-info">

                                                                <h3> <span>Reading: </span> Ut enim ad minim veniam</h3>
                                                            </div>
                                                            <div className="course__curriculum-meta">
                                                                <span className="time"> <i className="icon_clock_alt"></i> 22 minutes</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> */}
                                    </div>
                                </div>
                                <div className="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                                    <div className="course__review">
                                        <h3>Ratings</h3>
                                        {/* <p>Gosh william I'm telling crikey burke I don't want no agro A bit of how's your father bugger all mate off his nut that, what a plonker cuppa owt to do</p> */}

                                        <div className="course__review-rating mb-50">
                                            <div className="row g-0">
                                                <div className="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                                    <div className="course__review-rating-info grey-bg text-center">
                                                        <h5>{rating}</h5>
                                                        <Rating onClick={handleRating} ratingValue={rating} />
                                                        <p>Give us Rating</p>
                                                        {/* <ul>
                                                            <li><a href="#"> <i className="icon_star"></i> </a></li>
                                                            <li><a href="#"> <i className="icon_star"></i> </a></li>
                                                            <li><a href="#"> <i className="icon_star"></i> </a></li>
                                                            <li><a href="#"> <i className="icon_star"></i> </a></li>
                                                            <li><a href="#"> <i className="icon_star"></i> </a></li>
                                                        </ul>
                                                        <p>4 Ratings</p> */}
                                                    </div>
                                                </div>
                                                <div className="col-xxl-8 col-xl-8 col-lg-8 col-md-8 col-sm-8">
                                                    <div className="course__review-details grey-bg">
                                                        <h5>Detailed Rating</h5>
                                                        <div className="course__review-content mb-20">
                                                            <div className="course__review-item d-flex align-items-center justify-content-between">
                                                                <div className="course__review-text">
                                                                    <span>5 stars</span>
                                                                </div>
                                                                <div className="course__review-progress">
                                                                    <div className="single-progress" data-width="100%"></div>
                                                                </div>
                                                                <div className="course__review-percent">
                                                                    <h5>100%</h5>
                                                                </div>
                                                            </div>
                                                            <div className="course__review-item d-flex align-items-center justify-content-between">
                                                                <div className="course__review-text">
                                                                    <span>4 stars</span>
                                                                </div>
                                                                <div className="course__review-progress">
                                                                    <div className="single-progress" data-width="30%"></div>
                                                                </div>
                                                                <div className="course__review-percent">
                                                                    <h5>30%</h5>
                                                                </div>
                                                            </div>
                                                            <div className="course__review-item d-flex align-items-center justify-content-between">
                                                                <div className="course__review-text">
                                                                    <span>3 stars</span>
                                                                </div>
                                                                <div className="course__review-progress">
                                                                    <div className="single-progress" data-width="0%"></div>
                                                                </div>
                                                                <div className="course__review-percent">
                                                                    <h5>0%</h5>
                                                                </div>
                                                            </div>
                                                            <div className="course__review-item d-flex align-items-center justify-content-between">
                                                                <div className="course__review-text">
                                                                    <span>2 stars</span>
                                                                </div>
                                                                <div className="course__review-progress">
                                                                    <div className="single-progress" data-width="0%"></div>
                                                                </div>
                                                                <div className="course__review-percent">
                                                                    <h5>0%</h5>
                                                                </div>
                                                            </div>
                                                            <div className="course__review-item d-flex align-items-center justify-content-between">
                                                                <div className="course__review-text">
                                                                    <span>1 stars</span>
                                                                </div>
                                                                <div className="course__review-progress">
                                                                    <div className="single-progress" data-width="0%"></div>
                                                                </div>
                                                                <div className="course__review-percent">
                                                                    <h5>0%</h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {/* <div className="course__comment mb-75">
                                            <h3>2 Comments</h3>

                                            <ul>
                                                <li>
                                                    <div className="course__comment-box ">
                                                        <div className="course__comment-thumb float-start">
                                                            <img src="/assets/img/course/comment/course-comment-1.jpg" alt="" />
                                                        </div>
                                                        <div className="course__comment-content">
                                                            <div className="course__comment-wrapper ml-70 fix">
                                                                <div className="course__comment-info float-start">
                                                                    <h4>Eleanor Fant</h4>
                                                                    <span>July 14, 2022</span>
                                                                </div>
                                                                <div className="course__comment-rating float-start float-sm-end">
                                                                    <ul>
                                                                        <li><a href="#"> <i className="icon_star"></i> </a></li>
                                                                        <li><a href="#"> <i className="icon_star"></i> </a></li>
                                                                        <li><a href="#"> <i className="icon_star"></i> </a></li>
                                                                        <li><a href="#"> <i className="icon_star"></i> </a></li>
                                                                        <li><a href="#" > <i className="icon_star"></i> </a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div className="course__comment-text ml-70">
                                                                <p>So I said lurgy dropped a clanger Jeffrey bugger cuppa gosh David blatant have it, standard A bit of how's your father my lady absolutely.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div className="course__comment-box ">
                                                        <div className="course__comment-thumb float-start">
                                                            <img src="/assets/img/course/comment/course-comment-2.jpg" alt="" />
                                                        </div>
                                                        <div className="course__comment-content">
                                                            <div className="course__comment-wrapper ml-70 fix">
                                                                <div className="course__comment-info float-start">
                                                                    <h4>Shahnewaz Sakil</h4>
                                                                    <span>July 17, 2022</span>
                                                                </div>
                                                                <div className="course__comment-rating float-start float-sm-end">
                                                                    <ul>
                                                                        <li><a href="#"> <i className="icon_star"></i> </a></li>
                                                                        <li><a href="#"> <i className="icon_star"></i> </a></li>
                                                                        <li><a href="#"> <i className="icon_star"></i> </a></li>
                                                                        <li><a href="#"> <i className="icon_star"></i> </a></li>
                                                                        <li><a href="#" className="no-rating"> <i className="icon_star"></i> </a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div className="course__comment-text ml-70">
                                                                <p>David blatant have it, standard A bit of how's your father my lady absolutely.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div> */}
                                        {/* <div className="course__form">
                                            <h3>Write a Review</h3>
                                            <div className="course__form-inner">
                                                <form action="#">
                                                    <div className="row">
                                                        <div className="col-xxl-6">
                                                            <div className="course__form-input">
                                                                <input type="text" placeholder="Your Name" />
                                                            </div>
                                                        </div>
                                                        <div className="col-xxl-6">
                                                            <div className="course__form-input">
                                                                <input type="email" placeholder="Your Email" />
                                                            </div>
                                                        </div>
                                                        <div className="col-xxl-12">
                                                            <div className="course__form-input">
                                                                <input type="text" placeholder="Review Title" />
                                                            </div>
                                                        </div>
                                                        <div className="col-xxl-12">
                                                            <div className="course__form-input">
                                                                <div className="course__form-rating">
                                                                    <span>Rating : </span>
                                                                    <ul>
                                                                        <li><a href="#"> <i className="icon_star"></i> </a></li>
                                                                        <li><a href="#"> <i className="icon_star"></i> </a></li>
                                                                        <li><a href="#"> <i className="icon_star"></i> </a></li>
                                                                        <li><a href="#" className="no-rating" > <i className="icon_star"></i> </a></li>
                                                                        <li><a href="#" className="no-rating" > <i className="icon_star"></i> </a></li>
                                                                    </ul>
                                                                </div>
                                                                <textarea placeholder="Review Summary"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div className="row">
                                                        <div className="col-xxl-12">
                                                            <div className="course__form-btn mt-10 mb-55">
                                                                <button type="submit" className="e-btn">Submit Review</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div> */}
                                    </div>
                                </div>
                                <div className="tab-pane fade" id="member" role="tabpanel" aria-labelledby="member-tab">
                                    <div className="course__member mb-45">
                                        {
                                            singleTutor.singletutor.rel_tutor && singleTutor.singletutor.rel_tutor.length > 0 ? singleTutor.singletutor.rel_tutor.map(tut =>
                                                <>
                                                    <div className="course__member-item">
                                                        <div className="row align-items-center">
                                                            <div className="col-xxl-5 col-xl-5 col-lg-5 col-md-5 col-sm-6">
                                                                <div className="course__member-thumb d-flex align-items-center">
                                                                    <img src={generatePublicUrl('newtutor/' + tut.profile)} alt="" />
                                                                    <div className="course__member-name ml-20">
                                                                        <h5>{tut.name}</h5>
                                                                        {/* <span>Engineer</span> */}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div className="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-2 col-4">
                                                                <div className="course__member-info pl-45">
                                                                    <h5>{tut.count}</h5>
                                                                    <span>Subjects</span>
                                                                </div>
                                                            </div>
                                                            <div className="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-2 col-4">
                                                                <div className="course__member-info pl-70">
                                                                    <h5>{tut.state}</h5>
                                                                    <span>{tut.city}</span>
                                                                </div>
                                                            </div>
                                                            <div className="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-2 col-4">
                                                                <div className="course__member-info pl-85">
                                                                    <h5>3.00</h5>
                                                                    <span>Rating</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </>
                                            ) : ""
                                        }
                                    </div>
                                </div>
                                <Share />
                            </div>
                        </div>
                    </>
                ) : ""
            }
        </>
    )
}
