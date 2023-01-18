import React, { useState, useEffect } from 'react';
import { generatePublicUrl } from '../helpers/urlConfig';
import moment from 'moment';
import Link from 'next/link';

const EnquiryCard = ({ blog }) => {
    const [ispay, setIspay] = useState(0);
    // const [email, setEmail] = useState('');
    // // const [password, setPassword] = useState('');
    // const [phone, setPhone] = useState('');
    // const [cls, setCls] = useState('');
    // const [subject, setSubject] = useState('');
    // const [mode, setMode] = useState('');
    // const [message, setMessage] = useState('');
    // const [gender, setGender] = useState('');
    
    return (
        <div className="col-xxl-4 col-xl-4 col-lg-4 col-md-4" style={{boxShadow: '0px 4px 10px rgb(0 0 0 / 25%)',
        borderRadius: '15px', padding:'50px', height:'525px', 'overflow':'scroll', width:'350px', marginRight:'10px'}}>
            <div className="sign__input-wrapper mb-25">
                                <h5>Full Name</h5>
                                <div className="sign__input">
                                    <input
                                        type="text"
                                        placeholder="Full name"
                                        value={blog.name}
                                        disabled
                                        required
                                        // onChange={(e) => { setName(e.target.value) }}
                                        style={{height:'40px'}}
                                    />
                                    <i className="fal fa-user"></i>
                                </div>
                            </div>

                            <div className="sign__input-wrapper mb-25">
                                <h5> Mobile Number</h5>
                                <div className="sign__input">
                                    <input
                                        type={ispay==0?'password':'text'}
                                        required
                                        placeholder=" Mobile Number"
                                        disabled
                                        value={blog.mobile}
                                        // onChange={(e) => { setPhone(e.target.value) }}
                                        style={{height:'40px'}}
                                    />
                                    <i className="fal fa-mobile"></i>
                                </div>
                            </div>

                            <div className="sign__input-wrapper mb-25">
                                <h5>Email Address</h5>
                                <div className="sign__input">
                                    <input
                                        type={ispay==0?'password':'text'}
                                        required
                                        placeholder="e-mail address"
                                        disabled
                                        value={blog.email}
                                        // onChange={(e) => { setEmail(e.target.value) }}
                                        style={{height:'40px'}}
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
                                        disabled
                                        placeholder=" Class"
                                        value={blog.cls}
                                        // onChange={(e) => { setCls(e.target.value) }}
                                        style={{height:'40px'}}
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
                                        disabled
                                        placeholder=" Subject"
                                        value={blog.subject}
                                        // onChange={(e) => { setSubject(e.target.value) }}
                                        style={{height:'40px'}}
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
                                        disabled
                                        placeholder=" Class"
                                        value={blog.mode}
                                        // onChange={(e) => { setMode(e.target.value) }}
                                        style={{height:'40px'}}
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
                                        disabled
                                        placeholder="Message"
                                        value={blog.message}
                                        // onChange={(e) => { setMessage(e.target.value) }}
                                        style={{height:'40px'}}
                                    />
                                    <i className="fal fa-mobile"></i>
                                </div>
                            </div>

                            <div className="sign__input-wrapper mb-25">
                                <h5>Gender</h5>
                                <div className="sign__input">
                                    <input
                                        type="text"
                                        required
                                        disabled
                                        placeholder="Message"
                                        value={blog.gender}
                                        // onChange={(e) => { setMessage(e.target.value) }}
                                        style={{height:'40px'}}
                                    />
                                    <i className="fal fa-mobile"></i>
                                </div>
                            </div>
            
        </div>
    )
}

export default EnquiryCard;