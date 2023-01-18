import React, { useEffect, useState } from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { useRouter } from 'next/router';
import { getSingleTutor } from '../../../redux/actions';
import { RelatedSection } from './RelatedSection'
import { TabsSection } from './TabsSection'
import moment from 'moment';
import { Modal, Button} from 'react-bootstrap';
import { Rating } from 'react-simple-star-rating';
import { generatePublicUrl, base_url, api } from '../../../helpers/urlConfig';
import axios from 'axios';
import StudentInfo from '../../StudentInfo';
import Qualification from '../../Qualification';
import Review from '../../Review';
import Shim from '../../Shim';
import Board from './Board';


export const MainDetail = () => {
    const router = useRouter();
    const { search } = router.query;
    const dispatch = useDispatch();
    const singleTutor = useSelector(state => state.singleTutorData);
    const student = useSelector(state => state.student);

    const renderSubArray = (sub) => {
        const myArray = sub.split(",");
        return myArray;
    }

    const [show, setShow] = useState(false);
    const [rating, setRating] = useState(0);
    const [review, setReview] = useState('');

    const handleClose = () => setShow(false);
    const handleShow = () => setShow(true);

    const handleSetRate = (rate) => {
            setRating(rate);
    }

    const handleRating = () => {
        // alert(rating);
        // alert(review);
        // return;
        // var user_id = localStorage.getItem('user_id');
        var user_id = student.student_id;

        // var tutor_id = localStorage.getItem('tutor_id');
        var tutor_id = singleTutor.singletutor.tutors[0].id;
        // alert(tutor_id);
        // return;
        
        if (student.student_id == "") {
            handleClose();
            alert('You need to Click on Enquire button First...');
            return false;
        } else {
            const ratingData = {
                rating: rating, review: review, user_id: user_id, tutor_id: tutor_id
            }
            axios.post(`${api}/update/update-rating.php`, ratingData)
                .then(function (response) {
                    //handle success
                    alert(response.data.msg);
                    // console.log("success")
                    setRating(0);
                    setReview('');
                })
                .catch(function (response) {
                    //handle error
                    console.log(response)
                    console.log("sorry")
                });
            
            setShow(false);
            
        }
    }

    const cityModal = () => {
        return (
            <div className="card tutor-detail-card">
                <div className="card-body">
                    <div className="row">
                        <div className="col-md-12 col-xl-12">
                            <div className="grey-bg text-center">
                                <h5 style={{fontSize:'60px'}}>{rating}</h5>
                                <Rating 
                                onClick={handleSetRate} 
                                ratingValue={rating} />
                                <p>Give us Rating</p>                      
                            </div>
                        </div>
                        <div className="col-md-12 col-xl-12">
                            <div className="text-center">
                                <textarea 
                                value={review} 
                                className="form-control" 
                                placeholder="Write about yourself"
                                style={{ height: '100px' }}
                                onChange={(e) => { setReview(e.target.value)}}
                                >
                                </textarea>                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        )
    }

    const renderSubject = () => {
        renderSubArray(singleTutor.singletutor.tutors[0].subjects).length > 0 ?
            renderSubArray(singleTutor.singletutor.tutors[0].subjects).slice(0, 2).map(i =>
                <span className="badge bg-warning text-center" style={{ fontSize: '10px', marginRight: '3px', backgroundColor: '#4762a7', color: '#000' }}>{i.substring(0, 5) + '...'}</span>
            ) : null
    }

    useEffect(() => {
        if (search != undefined) {
            const bslug = {
                tutor_slug: `${search}`,
            }
            console.log(bslug);
            // return false;
            try {
                dispatch(getSingleTutor(bslug));
            } catch (e) {
                console.log(e);
            }
        }
    }, [search]);
    return (
        <>
                {/* {
                    singleTutor.singletutor.tutors && singleTutor.singletutor.tutors.length > 0 ? singleTutor.singletutor.tutors.map(tutor =>
                        <> */}
                                <div className="row">
                                    <div className="col-xxl-12">
                                    <div className="card tutor-detail-card">

                                            <div className="card-body"
                                            // style={{
                                            //     backgroundImage: 'url("/assets/img/course/teacher/teacher-1.jpg")',
                                            // }}
                                            >
                                                <div className="row">
                                                    <div className="col-md-3 col-xl-3">
                                                    {
                                                        singleTutor.singletutor.tutors && singleTutor.singletutor.tutors.length > 0 ? singleTutor.singletutor.tutors.map(tutor =>
                                                    <>
                                                        <div style={{ height: '171px',
                                                            borderRadius: '23px',
                                                            backgroundSize: '100%',
                                                            backgroundPosition: 'center', 
                                                            backgroundRepeat: 'no-repeat',
                                                            backgroundImage: `url(${generatePublicUrl('newtutor/' + tutor.profile)})`  }}></div>
                                                    </>
                                                        ) : 
                                                         <img style={{ height: '171px', borderRadius: '23px' }} src={generatePublicUrl('newtutor/teacher.png')} alt="" />
                                                    }
                                                    </div>
                                                    <div className="col-md-9 col-xl-9">
                                    {
                                        singleTutor.singletutor.tutors && singleTutor.singletutor.tutors.length > 0 ? singleTutor.singletutor.tutors.map(tutor =>
                                            <>
                                                {tutor.featured == 1 ? 
                                                    <h4 style={{ background: '#3F0E64', width: '120px', color: '#fff', fontSize: '15px', padding: '6px', borderRadius: '5px' }}>Featured Tutors</h4> : ""

                                                }

                                            </>
                                        ) : ""
                                    }
                                    {
                                        singleTutor.loading ? <>
                                            <Shim height={'40px'} width={'250px'} border={'4px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3'} />
                                        </> :
                                            singleTutor.singletutor.tutors && singleTutor.singletutor.tutors.length > 0 ? singleTutor.singletutor.tutors.map(tutor =>
                                                <span style={{ color: '#757575', fontWeight: 'bold', fontSize: '18px', marginRight: '10px' }}>{tutor.name}</span>
                                            ) : ""
                                    }

                                                        <img style={{ height: '25px', borderRadius: '23px' }} src="/assets/tutor/tick.png" alt="" />

                                                        <p style={{marginTop:'5px'}}>
                                                        <img style={{ height: '25px', borderRadius: '23px' }} src="/assets/tutor/location.png" alt="" />
                                                        
                                                        {singleTutor.singletutor.city}, {singleTutor.singletutor.state}
                                                        
                                                        </p>
                                                        {/* <button className="btn btn-primary">Enquire Now</button> */}
                                    {student.student_id == "" ? 
                                        <StudentInfo /> : 
                                            singleTutor.loading ? <>
                                                <Shim height={'40px'} width={'250px'} border={'4px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3'} />
                                            </> :
                                                singleTutor.singletutor.tutors && singleTutor.singletutor.tutors.length > 0 ? singleTutor.singletutor.tutors.map(tutor =>
                                                    <button className="e-btn" style={{ background: '#4B47E8', borderRadius: '4px', height: '35px', lineHeight: '1', textTransform: 'capitalize' }}>
                                                        <img style={{ height: '20px', marginRight: '5px', textTransform: 'capitalize' }} src="/assets/img/phone-call.png" alt="" />
                                                        {tutor.mobile}</button>
                                                ) : ""
                                        

                                    }
                               

                                                    </div>
                                                </div>
                                                <div>
                                                </div>
                                            </div>

                                        </div>

                                        <div className="card tutor-detail-card" >
                                            <div className="card-body">
                                                <div className="row">
                                                    <div className="col-md-3 col-xl-3">
                                                        <img style={{ height: '70px', borderRadius: '23px', marginLeft:'20%', marginTop:'5%' }} src="/assets/tutor/experiment.png" alt="" />
                                                    </div>
                                                    <div className="col-md-9 col-xl-9">
                                                        <p className="tutor-detail-heading">SUBJECTS OFFERED</p>

                                                    <div className="underborder"></div>

                                                        {
                                                             singleTutor.loading ? <>
                                                                <Shim height={'40px'} width={'250px'} border={'4px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3'} />
                                                            </> :
                                                                singleTutor.singletutor && singleTutor.singletutor.tutors[0].subjects.length > 0 ?
                                                                    renderSubArray(singleTutor.singletutor.tutors[0].subjects).slice(0, 2).map(i =>
                                                                        <span className="badge bg-warning text-center sub_badge">{i.substring(0, 10) + '...'}</span>
                                                                    ) : null
                                                        }
                                                        {/* {

                                                            renderSubArray(singleTutor.singletutor.tutors[0].subjects).length > 0 ?
                                                                renderSubArray(singleTutor.singletutor.tutors[0].subjects).slice(0, 2).map(i =>
                                                                    <span className="badge bg-warning text-center" style={{ fontSize: '10px', marginRight: '3px', backgroundColor: '#4762a7', color:'#000' }}>{i.substring(0, 5) + '...'}</span>
                                                                ) : null
                                                        } */}
                                                    </div>
                                                </div>
                                            
                                            <hr/>

                                                <div className="row">
                                                    <div className="col-md-3 col-xl-3">
                                                        <img style={{ height: '70px', borderRadius: '23px', marginLeft: '20%', marginTop: '20%' }} src="/assets/tutor/rating.png" alt="" />
                                                    </div>
                                                    <div className="col-md-9 col-xl-9">
                                                        <p className="tutor-detail-heading">REVIEW & RATINGS</p>
                                                        <div className="underborder"></div>

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
                                                        <button className="btn" onClick={handleShow} style={{background: '#FFFFFF', border: '3px solid #4B47E8',
                                                            boxSizing: 'border-box', borderRadius: '12px'}}>
                                                            Write a Review
                                                        </button>
                                                    </div>
                                                </div>
                                            <hr/>

                                            <div className="row">
                                                    <div className="col-md-3 col-xl-3">
                                                        <img style={{ height: '70px', borderRadius: '23px', marginLeft: '20%', marginTop: '20%' }} src="/assets/tutor/rating.png" alt="" />
                                                    </div>
                                                    <div className="col-md-9 col-xl-9">
                                                        <p className="tutor-detail-heading">ABOUT ME</p>
                                                        <div className="underborder"></div>
                                                        {
                                                            singleTutor.singletutor.tutors && singleTutor.singletutor.tutors.length > 0 ? singleTutor.singletutor.tutors.map(tutor =>
                                                                <p>{tutor.description}</p>
                                                            ) : ""
                                                        }
                                                        
                                                    </div>
                                                    
                                                </div>

                                                <div>
                                                </div>
                                            </div>

                                        </div>

                    {
                        singleTutor.singletutor.tutors && singleTutor.singletutor.tutors.length > 0 ? singleTutor.singletutor.tutors.map(tutor =>
                            <>
                                <Board x={tutor} />
                            </>
                        ) : ""
                    }


                                        

                                            {
                                                singleTutor.loading ? <>
                                                    <Shim height={'150px'} width={'700px'} border={'4px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3'} />
                                                    <Shim height={'150px'} width={'700px'} border={'4px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3'} />
                                                    <Shim height={'150px'} width={'700px'} border={'4px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3'} />
                                                </> :
                                                    singleTutor.singletutor.rating && singleTutor.singletutor.rating.length > 0 ? singleTutor.singletutor.rating.map(rate =>
                                                        <Review rate={rate} />) : ""
                                            }

                                            {/* {
                                                singleTutor.singletutor.rating && singleTutor.singletutor.rating.length > 0 ? singleTutor.singletutor.rating.map(rate =>
                                                    <>
                                                        <Review rate={rate} />
                                                        <hr />
                                                </>
                                                ):""
                                            } */}
                                                
                                            

                                       
                                            {
                                                singleTutor.singletutor.qualification && singleTutor.singletutor.qualification.length > 0 ? singleTutor.singletutor.qualification.map(qual =>
                                                    <>
                                                        <Qualification qual={qual}/>
                                                        <hr/>
                                                    </>
                                                ) : ""
                                            }
                                                
                                            </div>

                                        
                                </div>
                                    <Modal
                                    show={show}
                                    onHide={handleClose}
                                    backdrop="static"
                                    keyboard={false}
                                    >
                                <Modal.Header closeButton>
                                    <Modal.Title>Give Us Review & Rating</Modal.Title>
                                </Modal.Header>
                                <Modal.Body>
                                    {cityModal()}
                                </Modal.Body>
                                <Modal.Footer>
                                    <Button variant="secondary" onClick={handleClose}>
                                        Close
                                    </Button>
                                    <Button variant="primary" onClick={handleRating}>Apply</Button>
                                </Modal.Footer>
                            </Modal>

                        {/* </>
                    ) : ""
                } */}

                {/* <TabsSection /> */}
                {/* <RelatedSection /> */}

        </>
    )
}
