import React, { useState } from 'react';
import axios from 'axios';


export default function Contact() {
    const [name, setName] = useState('');
    const [email, setEmail] = useState('');
    const [msg, setMsg] = useState('');
    const [subject, setSubject] = useState('');


    const userSignup = (e) => {
        e.preventDefault();
        // const user = {
        //     selectedFile, name, email, msg, subject, mobile, state, scity, medium, cls, platform, board, description
        // }
        const formData = new FormData();
        formData.append('name', name);
        formData.append('email', email);
        formData.append('subject', subject);
        formData.append('msg', msg);

        console.log(formData);
        // return false;
        axios.post('https://studyfocus.in/cybertechMedia/api/new-study-api/register/enquiry-api.php', formData)
            .then(function (response) {
                //handle success
                if (response.data.status == 201) {
                    alert('Thank you for contacting. We will get back to you soon');
                }

            })
            .catch(function (response) {
                //handle error
                console.log(response)
                console.log("sorry")
            });

        setName('');
        setEmail('');
        setMsg('');
        setSubject('');

    }
    return (
        <>
            <section
                className="page__title-area page__title-height page__title-overlay d-flex align-items-center top_head_section"
            // style={{ backgroundImage: 'url(assets/img/page-title/page-title.jpg)' }}
            // style={{ minHeight: '150px' }}
            >
                <div className="container">
                    <div className="row">
                        <div className="col-xxl-12">
                            <div className="page__title-wrapper mt-110">
                                <h3 className="page__title">Contact</h3>
                                <nav aria-label="breadcrumb">
                                    <ol className="breadcrumb">
                                        <li className="breadcrumb-item"><a href="index-2.html">Home</a></li>
                                        <li className="breadcrumb-item active" aria-current="page">Contact</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section className="contact__area pt-15 pb-120">
                <div className="container">
                    <div className="row">
                        <div className="col-xxl-7 col-xl-7 col-lg-6">
                            <div className="contact__wrapper">
                                <div className="section__title-wrapper mb-40">
                                    <h2 className="section__title">Get in<span className="yellow-bg yellow-bg-big">touch<img src="assets/img/shape/yellow-bg.png" alt="" /></span></h2>
                                    <p>Have a question or just want to say hi? We'd love to hear from you.</p>
                                </div>
                                <div className="contact__form">
                                    <form onSubmit={userSignup}>
                                        <div className="row">
                                            <div className="col-xxl-6 col-xl-6 col-md-6">
                                                <div className="contact__form-input">
                                                    <input
                                                        type="text"
                                                        placeholder="Your Name"
                                                        value={name}
                                                        required
                                                        onChange={(e) => { setName(e.target.value) }}
                                                    />
                                                </div>
                                            </div>
                                            <div className="col-xxl-6 col-xl-6 col-md-6">
                                                <div className="contact__form-input">
                                                    <input
                                                        type="email"
                                                        required
                                                        placeholder="e-mail address"
                                                        value={email}
                                                        onChange={(e) => { setEmail(e.target.value) }}
                                                    />
                                                </div>
                                            </div>
                                            <div className="col-xxl-12">
                                                <div className="contact__form-input">
                                                    <input
                                                        type="text"
                                                        placeholder="Subject"
                                                        value={subject}
                                                        required
                                                        onChange={(e) => { setSubject(e.target.value) }}
                                                    />
                                                </div>
                                            </div>
                                            <div className="col-xxl-12">
                                                <div className="contact__form-input">
                                                    <textarea
                                                        placeholder="Enter Your Message"
                                                        required
                                                        value={msg}
                                                        onChange={(e) => { setMsg(e.target.value) }}></textarea>
                                                </div>
                                            </div>
                                            <div className="col-xxl-12">
                                                <div className="contact__form-agree  d-flex align-items-center mb-20">
                                                    <input className="e-check-input" type="checkbox" id="e-agree" required />
                                                    <label className="e-check-label" for="e-agree">I agree to the<a href="#">Terms & Conditions</a></label>
                                                </div>
                                            </div>
                                            <div className="col-xxl-12">
                                                <div className="contact__btn">
                                                    <button type="submit" className="e-btn">Send your message</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div className="col-xxl-4 offset-xxl-1 col-xl-4 offset-xl-1 col-lg-5 offset-lg-1">
                            <div className="contact__info white-bg p-relative z-index-1">
                                <div className="contact__shape">
                                    <img className="contact-shape-1" src="assets/img/contact/contact-shape-1.png" alt="" />
                                    <img className="contact-shape-2" src="assets/img/contact/contact-shape-2.png" alt="" />
                                    <img className="contact-shape-3" src="assets/img/contact/contact-shape-3.png" alt="" />
                                </div>
                                <div className="contact__info-inner white-bg">
                                    <ul>
                                        <li>
                                            <div className="contact__info-item d-flex align-items-start mb-35">
                                                <div className="contact__info-icon mr-15">
                                                    <svg className="map" viewBox="0 0 24 24">
                                                        <path className="st0" d="M21,10c0,7-9,13-9,13s-9-6-9-13c0-5,4-9,9-9S21,5,21,10z" />
                                                        <circle className="st0" cx="12" cy="10" r="3" />
                                                    </svg>
                                                </div>
                                                <div className="contact__info-text">
                                                    <h4>India Office</h4>
                                                    <p><a target="_blank" href="https://www.google.com/maps/place/Dhaka/@23.7806207,90.3492859,12z/data=!3m1!4b1!4m5!3m4!1s0x3755b8b087026b81:0x8fa563bbdd5904c2!8m2!3d23.8104753!4d90.4119873">
                                                        Hariram Apartment, Kanke Road,Ranchi, Jharkhand
                                                        </a>
                                                    </p>

                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div className="contact__info-item d-flex align-items-start mb-35">
                                                <div className="contact__info-icon mr-15">
                                                    <svg className="mail" viewBox="0 0 24 24">
                                                        <path className="st0" d="M4,4h16c1.1,0,2,0.9,2,2v12c0,1.1-0.9,2-2,2H4c-1.1,0-2-0.9-2-2V6C2,4.9,2.9,4,4,4z" />
                                                        <polyline className="st0" points="22,6 12,13 2,6 " />
                                                    </svg>
                                                </div>
                                                <div className="contact__info-text">
                                                    <h4>Email us directly</h4>
                                                    <p><a href="https://themepure.net/cdn-cgi/l/email-protection#02717772726d70764267667761636e2c616d6f"><span className="__cf_email__" data-cfemail="c9babcb9b9a6bbbd89acadbcaaa8a5e7aaa6a4">sfhtdc2020@gmail.com</span></a></p>
                                                    {/* <p><a href="https://themepure.net/cdn-cgi/l/email-protection#96fff8f0f9d6f3f2e3f5f7fab8f5f9fb"> <span className="__cf_email__" data-cfemail="543d3a323b143130213735387a373b39">[email&#160;protected]</span></a></p> */}
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div className="contact__info-item d-flex align-items-start mb-35">
                                                <div className="contact__info-icon mr-15">
                                                    <svg className="call" viewBox="0 0 24 24">
                                                        <path className="st0" d="M22,16.9v3c0,1.1-0.9,2-2,2c-0.1,0-0.1,0-0.2,0c-3.1-0.3-6-1.4-8.6-3.1c-2.4-1.5-4.5-3.6-6-6  c-1.7-2.6-2.7-5.6-3.1-8.7C2,3.1,2.8,2.1,3.9,2C4,2,4.1,2,4.1,2h3c1,0,1.9,0.7,2,1.7c0.1,1,0.4,1.9,0.7,2.8c0.3,0.7,0.1,1.6-0.4,2.1  L8.1,9.9c1.4,2.5,3.5,4.6,6,6l1.3-1.3c0.6-0.5,1.4-0.7,2.1-0.4c0.9,0.3,1.8,0.6,2.8,0.7C21.3,15,22,15.9,22,16.9z" />
                                                    </svg>
                                                </div>
                                                <div className="contact__info-text">
                                                    <h4>What's App No</h4>
                                                    <p><a href="tel:+(426)-742-26-44">+(91) 7970615041</a></p>
                                                    {/* <p><a href="tel:+(224)-762-442-32">+(224) 762 442 32</a></p> */}
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <div className="contact__social pl-30">
                                        <h4>Follow Us</h4>
                                        <ul>
                                            <li><a href="https://www.facebook.com/Studyfocusweb/" className="fb" ><i className="social_facebook"></i></a></li>
                                            <li><a href="https://instagram.com/studyfocusweb" className="tw" ><i className="social_instagram"></i></a></li>
                                            <li><a href="#" className="pin" ><i className="social_pinterest"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section className="contact__area grey-bg-2 pt-120 pb-90 p-relative fix">
                <div className="contact__shape">
                    <img className="contact-shape-5" src="assets/img/contact/contact-shape-5.png" alt="" />
                    <img className="contact-shape-4" src="assets/img/contact/contact-shape-4.png" alt="" />
                </div>
                <div className="container">
                    <div className="row">
                        <div className="col-xxl-5 offset-xxl-1 col-xl-5 offset-xl-1 col-lg-5 offset-lg-1 col-md-6">
                            <div className="contact__item text-center mb-30 transition-3 white-bg">
                                <div className="contact__icon d-flex justify-content-center align-items-end">
                                    <svg viewBox="0 0 24 24">
                                        <circle className="st0" cx="12" cy="12" r="10" />
                                        <path className="st0" d="M8,14c0,0,1.5,2,4,2s4-2,4-2" />
                                        <line className="st0" x1="9" y1="9" x2="9" y2="9" />
                                        <line className="st0" x1="15" y1="9" x2="15" y2="9" />
                                    </svg>
                                </div>
                                <div className="contact__content">
                                    <h3 className="contact__title">Knowledge Base</h3>
                                    <p>My good sir plastered cuppa barney cobblers mush argy bargy ruddy.</p>
                                    <a href="contact.html" className="e-btn e-btn-border">Visit Documentation</a>
                                </div>
                            </div>
                        </div>
                        <div className="col-xxl-5 col-xl-5  col-lg-5 col-md-6">
                            <div className="contact__item text-center mb-30 transition-3 white-bg">
                                <div className="contact__icon d-flex justify-content-center align-items-end">
                                    <svg viewBox="0 0 24 24">
                                        <path className="st0" d="M21,10.8c0,1.3-0.3,2.6-0.9,3.8c-1.4,2.9-4.4,4.7-7.6,4.7c-1.3,0-2.6-0.3-3.8-0.9L3,20.3l1.9-5.7  C4.3,13.4,4,12.1,4,10.8c0-3.2,1.8-6.2,4.7-7.6c1.2-0.6,2.5-0.9,3.8-0.9H13c4.3,0.2,7.8,3.7,8,8V10.8z" />
                                        <g>
                                            <circle className="st1" cx="9.3" cy="10.5" r="0.5" />
                                            <circle className="st1" cx="12.5" cy="10.5" r="0.5" />
                                            <circle className="st1" cx="15.7" cy="10.5" r="0.5" />
                                        </g>
                                    </svg>
                                </div>
                                <div className="contact__content">
                                    <h3 className="contact__title">Online Support</h3>
                                    <p>My good sir plastered cuppa barney cobblers mush argy bargy ruddy.</p>
                                    <a href="contact.html" className="e-btn e-btn-border">Send a Ticket</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </>
    )
}