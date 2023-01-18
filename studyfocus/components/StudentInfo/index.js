import React, { useState, useEffect } from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { addEnquiry } from '../../redux/actions';
import { useRouter } from 'next/router';


import Link from 'next/link';
import { Button, Modal } from 'react-bootstrap';
import axios from 'axios';
import axiosInstance from '../../helpers/axios';


export default function StudentInfo() {
    const router = useRouter();
    const { search } = router.query;

    const [name, setName] = useState('');
    const [email, setEmail] = useState('');
    // const [password, setPassword] = useState('');
    const [phone, setPhone] = useState('');
    const [cls, setCls] = useState('');
    const [subject, setSubject] = useState('');
    const [mode, setMode] = useState('');
    const [message, setMessage] = useState('');
    const [gender, setGender] = useState('');



    const [show, setShow] = useState(false);
    const [showEnquiry, setShowEnquiry] = useState(false);


    // const [send, setSend] = useState(0);


    const dispatch = useDispatch();


    const userSignup = (e) => {
        setShow(false);
        e.preventDefault();
        const user = {
             name, email, phone, search 
        }
        dispatch(addEnquiry(user));
        setName('');
        setEmail('');
        setPhone('');
    }

    const userEnquiry = async(e) => {
        setShowEnquiry(false);
        e.preventDefault();
        if(name=="" || email=="" || phone=="" || search=="" || cls == "" || subject == "" || mode == "" || message == "" || gender == ""){
            alert("Please fill all the fields to continue..");
            return;
        }
        const user = {
             name, email, phone, search, cls, subject, mode, message, gender 
        }
        // console.log(user, 'hulu');
        const res = await axiosInstance.post(`/register/save-enquiry-api.php`, {
            ...user
        })
        if (res.data.status === 201) {
            alert("Successfully Saved Enquiry");
        }
        setName('');
        setEmail('');
        setPhone('');
        setCls('');
        setSubject('');
        setMode('');
        setMessage('');
        setGender('');
    }

    const handleCloseEEnquiry = () => setShow(false);
    const handleShow = () => setShow(true);

    const handleCloseEnquiry = () => setShowEnquiry(false);
    const handleShowEnquiry = () => setShowEnquiry(true);

    return (
        <>
            <section className="signup__area po-rel-z1 pt-10 pb-1">
                <button onClick={handleShow} className="e-btn" style={{
                    background: '#149B42', borderRadius: '5px', height: '35px', lineHeight: '1', textTransform: 'capitalize'
                }}>
                    <img style={{ height: '20px', marginRight: '5px', textTransform: 'capitalize' }} src="/assets/img/phone-call.png" alt="" />
                    View Contact</button>

                    <button onClick={handleShowEnquiry} className="e-btn" style={{
                    background: '#2B4EFF', marginLeft: '20px', borderRadius: '5px', height: '35px', lineHeight: '1', textTransform: 'capitalize'
                }}>
                    <img style={{ height: '20px', marginRight: '5px', textTransform: 'capitalize' }} src="/assets/img/enquiry.png" alt="" />
                    Send Enquiry</button>
                
                <Modal show={show} onHide={handleCloseEEnquiry}>
                    <Modal.Header closeButton>
                        <Modal.Title>Please Submit your Info first</Modal.Title>
                    </Modal.Header>
                    <Modal.Body>
                        <form onSubmit={userSignup}>

                            <div className="sign__input-wrapper mb-25">
                                <h5>Full Name</h5>
                                <div className="sign__input">
                                    <input
                                        type="text"
                                        placeholder="Full name"
                                        value={name}
                                        required
                                        onChange={(e) => { setName(e.target.value) }}
                                    />
                                    <i className="fal fa-user"></i>
                                </div>
                            </div>
                            <div className="sign__input-wrapper mb-25">
                                <h5>Email Address</h5>
                                <div className="sign__input">
                                    <input
                                        type="email"
                                        required
                                        placeholder="e-mail address"
                                        value={email}
                                        onChange={(e) => { setEmail(e.target.value) }}
                                    />
                                    <i className="fal fa-envelope"></i>
                                </div>
                            </div>

                            <div className="sign__input-wrapper mb-25">
                                <h5>Enter Mobile Number</h5>
                                <div className="sign__input">
                                    <input
                                        type="text"
                                        required
                                        placeholder="Enter Mobile Number"
                                        value={phone}
                                        onChange={(e) => { setPhone(e.target.value) }}
                                    />
                                    <i className="fal fa-mobile"></i>
                                </div>
                            </div>

                            <div class="sign__agree d-flex align-items-center">
                                <input class="m-check-input" type="checkbox" id="m-agree"/>
                                    <label class="m-check-label" for="m-agree">I agree with <span style={{color:'#F170D3'}}>terms and condition and privacy policy</span></label>
                                </div>
                            <br/>

                            <button type="submit" className="e-btn w-100">Submit</button>
                        </form>
                    </Modal.Body>

                </Modal>

                <Modal show={showEnquiry} onHide={handleCloseEnquiry}>
                    <Modal.Header closeButton>
                        <Modal.Title>Please Submit your Info First</Modal.Title>
                    </Modal.Header>
                    <Modal.Body>
                        <form onSubmit={userEnquiry}>

                            <div className="sign__input-wrapper mb-25">
                                <h5>Full Name</h5>
                                <div className="sign__input">
                                    <input
                                        type="text"
                                        placeholder="Full name"
                                        value={name}
                                        required
                                        onChange={(e) => { setName(e.target.value) }}
                                    />
                                    <i className="fal fa-user"></i>
                                </div>
                            </div>

                            <div className="sign__input-wrapper mb-25">
                                <h5>Enter Mobile Number</h5>
                                <div className="sign__input">
                                    <input
                                        type="text"
                                        required
                                        placeholder="Enter Mobile Number"
                                        value={phone}
                                        onChange={(e) => { setPhone(e.target.value) }}
                                    />
                                    <i className="fal fa-mobile"></i>
                                </div>
                            </div>

                            <div className="sign__input-wrapper mb-25">
                                <h5>Email Address</h5>
                                <div className="sign__input">
                                    <input
                                        type="email"
                                        required
                                        placeholder="e-mail address"
                                        value={email}
                                        onChange={(e) => { setEmail(e.target.value) }}
                                    />
                                    <i className="fal fa-envelope"></i>
                                </div>
                            </div>

                            <div className="sign__input-wrapper mb-25">
                                <h5>Class</h5>
                                <div className="sign__input">
                                    <input
                                        type="text"
                                        required
                                        placeholder="Enter Class"
                                        value={cls}
                                        onChange={(e) => { setCls(e.target.value) }}
                                    />
                                    <i className="fal fa-mobile"></i>
                                </div>
                            </div>

                            <div className="sign__input-wrapper mb-25">
                                <h5>Subject</h5>
                                <div className="sign__input">
                                    <input
                                        type="text"
                                        required
                                        placeholder="Enter Subject"
                                        value={subject}
                                        onChange={(e) => { setSubject(e.target.value) }}
                                    />
                                    <i className="fal fa-mobile"></i>
                                </div>
                            </div>

                            <div className="sign__input-wrapper mb-25">
                                <h5>Mode</h5>
                                <div className="sign__input">
                                    <input
                                        type="text"
                                        required
                                        placeholder="Enter Class"
                                        value={mode}
                                        onChange={(e) => { setMode(e.target.value) }}
                                    />
                                    <i className="fal fa-mobile"></i>
                                </div>
                            </div>

                            <div className="sign__input-wrapper mb-25">
                                <h5>Message</h5>
                                <div className="sign__input">
                                    <input
                                        type="text"
                                        required
                                        placeholder="Enter Message"
                                        value={message}
                                        onChange={(e) => { setMessage(e.target.value) }}
                                    />
                                    <i className="fal fa-mobile"></i>
                                </div>
                            </div>
                         <div className="sign__input-wrapper mb-25">
                                <h5>Gender</h5>
                            <div className="sign__input"></div>

                            <input type="radio" value={gender} onChange={(e) => {setGender('male')}} className="btn-check" name="options-outlined" id="success-outlined" autocomplete="off" checked/>
                            <label style={{width:'150px'}} className="btn btn-outline-success" for="success-outlined">Male</label>

                            <input type="radio" value={gender} onChange={(e) => {setGender('female')}} className="btn-check" name="options-outlined" id="danger-outlined" autocomplete="off"/>
                            <label style={{width:'150px', marginLeft:'50px'}} className="btn btn-outline-danger" for="danger-outlined">Female</label>
                        </div>

                            <div class="sign__agree d-flex align-items-center">
                                <input class="m-check-input" type="checkbox" id="m-agree"/>
                                    <label class="m-check-label" for="m-agree">I agree with <span style={{color:'#F170D3'}}>terms and condition and privacy policy</span></label>
                                </div>
                            <br/>

                            <button type="submit" className="e-btn w-100">Submit</button>
                        </form>
                    </Modal.Body>

                </Modal>
            </section>

        </>
    )
}