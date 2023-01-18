import React, { useState, useEffect } from 'react';
import Link from 'next/link'
import {base_url_tutor} from '../../helpers/urlConfig';


// import { useDispatch, useSelector } from 'react-redux';
// import { getInitialData } from '../../redux/actions';

export default function HeroSection() {
    const [localCityName, setlocalCityName] = useState('Select City');
    const checkcity = () => {
        (localStorage.getItem('localCityName') == null || localStorage.getItem('localCityName') == '') ? localStorage.setItem('localCityName', "Select City") : setlocalCityName(localStorage.getItem('localCityName'));
    }
    const genLinkUrl = () => {
        if (localCityName == "Select City") {
            return base_url_tutor + 'India';
        } else {
            return base_url_tutor + `${localCityName}`;
        }
    }

    // const dispatch = useDispatch();
    useEffect(() => {
        checkcity();
    }, [localCityName]);
    return (
        <section className="hero__area hero__height d-flex align-items-center p-relative" style={{ marginTop: '5%', background: '#f7f7f7' }}>
            <div className="hero__shape">
                <img className="hero-1-circle" src="assets/img/shape/hero/hero-1-circle.png" alt="" />
                <img className="hero-1-circle-2" src="assets/img/shape/hero/hero-1-circle-2.png" alt="" />
                <img className="hero-1-dot-2" src="assets/img/shape/hero/hero-1-dot-2.png" alt="" />
            </div>
            <div className="container">
                <div className="hero__content-wrapper mt-90">
                    <div className="row align-items-center">
                        <div className="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                            <div className="hero__content p-relative z-index-1">
                                <h3 className="hero__title">
                                    <span>Access 2700+ tutors</span>
                                    <span className="yellow-shape">India's <img src="assets/img/shape/yellow-bg.png" alt="yellow-shape" /> </span>
                                    Premier Tutor's and Institute's Directory.
                              </h3>
                                <p>Meet home tutors, online tutors, institutes, counselors, placement agencies for your study and placement needs.</p>
                                <button className="e-btn e-btn-2">
                                    <Link href={genLinkUrl()}>View all Tutors</Link>
                                </button>
                                {/* <a href="view-all-tutors" className="e-btn">View all Tutors</a> */}
                            </div>
                        </div>
                        <div className="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                            <div className="hero__thumb d-flex p-relative">
                                <div className="hero__thumb-shape">
                                    <img className="hero-1-dot" src="assets/img/shape/hero/hero-1-dot.png" alt="" />
                                    <img className="hero-1-circle-3" src="assets/img/shape/hero/hero-1-circle-3.png" alt="" />
                                    <img className="hero-1-circle-4" src="assets/img/shape/hero/hero-1-circle-4.png" alt="" />
                                </div>
                                <div className="hero__thumb-big mr-30">
                                    <img src="assets/img/hero/StudyFocus.jpg" alt="" />
                                    <div className="hero__quote hero__quote-animation">
                                        <span>Education is the most powerful weapon we can use to change the world.</span>
                                        <h4>“Nelson Mandela”</h4>
                                    </div>
                                </div>
                                <div className="hero__thumb-sm mt-50 d-none d-lg-block">
                                    <img src="assets/img/hero/hero-sm-1.jpg" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    )
}