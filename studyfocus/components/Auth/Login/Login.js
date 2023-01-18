import React, { useState, useEffect } from 'react';
import Link from 'next/link';
import { useDispatch, useSelector } from 'react-redux';
import { login } from '../../../redux/actions';
import Router from 'next/router';


export default function Login() {

    const [email, setEmail] = useState('');
    const [signtext, setSigntext] = useState('Sign In');
    const [type, setType] = useState('');
    const [password, setPassword] = useState('');

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
        // alert('hi');
        // return false;
        setSigntext("Signing In...");
        e.preventDefault();
        if (email == '' || password == '' || type == '') {
            alert('Please Select All the Fields..');
            setSigntext("Sign In");


            return false;
        }

        const user = {
            email, password, type
        }
        // console.log(user);
        // return false;
        dispatch(login(user));
        setSigntext("Sign In");

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
                                <h2 className="section__title">Sign in to <br />  StudyFocus</h2>
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
                                    <form onSubmit={userLogin}>
                                        <div className="sign__input-wrapper mb-25">
                                            <h5>Login As</h5>
                                            <div className="sign__select">
                                                <select className="apna-form-control" required value={type} onChange={(e) => { setType(e.target.value) }} style={{ width: '100%' }}>
                                                    <option value="0">Login As</option>
                                                    <option value="tutor">Tutor</option>
                                                    <option value="agency">Institute</option>
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
                                        <div className="sign__input-wrapper mb-10">
                                            <h5>Password</h5>
                                            <div className="sign__input">
                                                <input
                                                    type="text"
                                                    placeholder="Password"
                                                    value={password}
                                                    onChange={(e) => { setPassword(e.target.value) }}
                                                />
                                                <i className="fal fa-lock"></i>
                                            </div>
                                        </div>
                                        <div className="sign__action d-sm-flex justify-content-between mb-30">
                                            <div className="sign__agree d-flex align-items-center">
                                                <input className="m-check-input" type="checkbox" id="m-agree" />
                                                <label className="m-check-label" for="m-agree">Keep me signed in
                                       </label>
                                            </div>
                                            <div className="sign__forgot">
                                                <Link href="/reset-password">Forgot your password?</Link>
                                            </div>
                                        </div>
                                        <button className="e-btn  w-100"> <span></span>{signtext}</button>
                                        <div className="sign__new text-center mt-20">
                                            <p>New to StudyFocus? <Link href="/signup-tutor">Sign Up</Link></p>
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