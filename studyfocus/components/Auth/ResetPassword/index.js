import React, { useState, useEffect } from 'react';
import Link from 'next/link';
import { useDispatch, useSelector } from 'react-redux';
import { login } from '../../../redux/actions';
import Router from 'next/router';
import axios from 'axios'


export default function ResetPassword() {

    const [email, setEmail] = useState('');
    const [type, setType] = useState('');
    // const [password, setPassword] = useState('');

    const getUser = () => {
        var username = localStorage.getItem('user_name');
        return username;
    }

    useEffect(() => {
        var name = getUser();
        if (name != null) {
            Router.push('/');
        }
    }, []);

    const dispatch = useDispatch();

    const userLogin = (e) => {

        e.preventDefault();

        const user = {
            email, type
        }
        // console.log(user);
        axios.post('https://cms.cybertizeweb.com/studyfocus/cybertechMedia/api/new-study-api/reset-password/send-secure-pin.php', user)
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
                                <h2 className="section__title">Reset Password <br /> Study Focus</h2>
                                <p>it you don't have an account you can <Link href="/signup">Register here!</Link></p>
                            </div>
                        </div>
                    </div>
                    <div className="row">
                        <div className="col-xxl-6 offset-xxl-3 col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                            <div className="sign__wrapper white-bg">

                                <div className="sign__form">
                                    <form onSubmit={userLogin}>
                                        <div className="sign__input-wrapper mb-25">
                                            <h5>Login As</h5>
                                            <div className="sign__select">
                                                <select value={type} onChange={(e) => { setType(e.target.value) }} style={{ width: '100%' }}>
                                                    <option value="" selected>Login As</option>
                                                    <option value="tutor">Tutor</option>
                                                    <option value="agency">Agency</option>
                                                    <option value="councellor">Councellor</option>
                                                </select>

                                            </div>
                                        </div>
                                        <div className="sign__input-wrapper mb-25">
                                            <h5>Work email</h5>
                                            <div className="sign__input">
                                                <input
                                                    type="email"
                                                    placeholder="e-mail address"
                                                    value={email}
                                                    onChange={(e) => { setEmail(e.target.value) }}
                                                />
                                                <i className="fal fa-envelope"></i>
                                            </div>
                                        </div>


                                        <button className="e-btn  w-100"> <span></span> Reset</button>
                                        <div className="sign__new text-center mt-20">
                                            <p>New to StudyFocus? <Link href="/signup">Sign Up</Link></p>
                                        </div>
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