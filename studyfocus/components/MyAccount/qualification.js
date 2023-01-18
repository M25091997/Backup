import React, { useState, useEffect } from 'react';
import Link from 'next/link';
import { useDispatch, useSelector } from 'react-redux';
import { login, getQualification } from '../../redux/actions';
import Router from 'next/router';
import { useRouter } from 'next/router';
import { base_url } from '../../helpers/urlConfig';
import axios from 'axios'



const Qualification = () => {

    const router = useRouter();
    const { quaId } = router.query;
    const tutorqual = useSelector(state => state.tutorqual);


    const [quali, setQuali] = useState('');
    const [uni, setUni] = useState('');
    const [year, setYear] = useState('');
    const [place, setPlace] = useState('');

    // const getUser = () => {
    //     var username = localStorage.getItem('user_name');
    //     return username;
    // }

    useEffect(() => {
        if (quaId != undefined) {
            const qId = {
                q_Id: `${quaId}`,
            }
            // console.log(qId);
            // return;
            try {
                dispatch(getQualification(qId));
            } catch (e) {
                console.log(e);
            }
        }
    }, [quaId]);

    const dispatch = useDispatch();

    const userQualification = (e) => {
        e.preventDefault();
        const formData = new FormData();
        formData.append('id', quaId);
        formData.append('university', uni);
        formData.append('qualification', quali);
        formData.append('year_from', year);
        formData.append('place', place);
        // formData.append('year_to', to);


        axios.post('https://cybertizeweb.com/cms/studyfocus/cybertechMedia/api/new-study-api/update/update-qualification.php', formData)
            .then(function (response) {
                //handle success
                console.log(response)
                console.log("success")
            })
            .catch(function (response) {
                //handle error
                console.log(response)
                console.log("sorry")
            });

        // setQualif('');
        // setUniversity('');
        // setFrom('');
        // setTo('');

    }
    return (
        <>
            <section className="signup__area po-rel-z1 pt-100 pb-145">
                <div className="sign__shape">
                    <img className="man-1" src="/assets/img/icon/sign/man-1.png" alt="" />
                    <img className="man-2" src="/assets/img/icon/sign/man-2.png" alt="" />
                    <img className="circle" src="/assets/img/icon/sign/circle.png" alt="" />
                    <img className="zigzag" src="/assets/img/icon/sign/zigzag.png" alt="" />
                    <img className="dot" src="/assets/img/icon/sign/dot.png" alt="" />
                    <img className="bg" src="/assets/img/icon/sign/sign-up.png" alt="" />
                </div>
                <div className="container">
                    <div className="row">
                        <div className="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2">
                            <div className="section__title-wrapper text-center mb-55">
                                <h2 className="section__title">Edit Qualification</h2>
                            </div>
                        </div>
                    </div>
                    <div className="row">
                        <div className="col-xxl-6 offset-xxl-3 col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                            <div className="sign__wrapper white-bg">
                                {/* <div className="sign__header mb-35">
                                    <div className="sign__in text-center">
                                        <a href="#" className="sign__social text-start mb-15"><i className="fab fa-facebook-f"></i>Sign in with Facebook</a>
                                        <p> <span>........</span> Or, <a href="sign-in.html">sign in</a> with your email<span> ........</span> </p>
                                    </div>
                                </div> */}
                                <div className="sign__form">
                                    <form onSubmit={userQualification}>
                                        {
                                            tutorqual.qual && tutorqual.qual.length > 0 ? tutorqual.qual.map(qual =>
                                                <>
                                                    <div className="sign__input-wrapper mb-25">
                                                        <h5>Enter Qualification</h5>
                                                        <div className="sign__input">
                                                            <input
                                                                type="text"
                                                                placeholder={qual.qualification}
                                                                value={quali}
                                                                required
                                                                onChange={(e) => { setQuali(e.target.value) }}
                                                            />
                                                            <i className="fal fa-user"></i>
                                                        </div>
                                                    </div>

                                                    <div className="sign__input-wrapper mb-25">
                                                        <h5>Enter University</h5>
                                                        <div className="sign__input">
                                                            <input
                                                                type="text"
                                                                placeholder={qual.university}
                                                                value={uni}
                                                                required
                                                                onChange={(e) => { setUni(e.target.value) }}
                                                            />
                                                            <i className="fal fa-university"></i>
                                                        </div>
                                                    </div>

                                                    <div className="sign__input-wrapper mb-25">
                                                        <h5>Enter Year</h5>
                                                        <div className="sign__input">
                                                            <input
                                                                type="text"
                                                                placeholder={qual.year_from}
                                                                value={year}
                                                                required
                                                                onChange={(e) => { setYear(e.target.value) }}
                                                            />
                                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                                        </div>
                                                    </div>

                                                    <div className="sign__input-wrapper mb-25">
                                                        <h5>Enter Place</h5>
                                                        <div className="sign__input">
                                                            <input
                                                                type="text"
                                                                placeholder={qual.place}
                                                                value={place}
                                                                required
                                                                onChange={(e) => { setPlace(e.target.value) }}
                                                            />
                                                            <i className="fa fa-globe"></i>
                                                        </div>
                                                    </div>
                                                </>

                                            ) : <center><img width={'50%'} src={base_url + "/assets/img/logo/notfound.jpg"} alt="logo" /></center>
                                        }

                                        <button className="e-btn w-100" type="submit">Update Qualification</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </>
    )
}

export default Qualification;