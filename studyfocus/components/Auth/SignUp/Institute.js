import React, { useState, useEffect } from 'react';
import Link from 'next/link';
import { useDispatch, useSelector } from 'react-redux';
import { signupStudent, signupAgency, signupTutor, getInitialSignup } from '../../../redux/actions';
import Router from 'next/router';
import { Col, Form } from "react-bootstrap";
import axios from 'axios'


export default function SignUp() {
    const [type, setType] = useState('');
    const [headtext, setHeadtext] = useState('Join As Institute');
    const [name, setName] = useState('');
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [experience, setExperience] = useState('');
    const [feerange, setFeerange] = useState('');
    // const [feemax, setFeemax] = useState('');

    const [subject, setSubject] = useState([]);
    const [medium, setMedium] = useState([]);
    const [cls, setCls] = useState([]);
    const [place, setPlace] = useState([]);
    const [platform, setPlatform] = useState([]);
    const [board, setBoard] = useState([]);
    const [mobile, setMobile] = useState('');
    const [state, setState] = useState('');
    const [city, setCity] = useState([]);
    const [scity, setSCity] = useState('');
    const [description, setDescription] = useState('');
    const [step1, setStep1] = useState('1');
    const [step2, setStep2] = useState('');
    const [step3, setStep3] = useState('');
    const [selectedFile, setSelectedFile] = useState();
    const [isSelected, setIsSelected] = useState(false);
    const [profile, setProfile] = useState('');


    const changeHandler = (event) => {
        setSelectedFile(event.target.files[0]);
        setIsSelected(true);
    };

    const dispatch = useDispatch();
    const initialSignupData = useSelector(state => state.initialSignupData);

    // we will use async/await to fetch this data
    async function getCity(state) {
        const res = await fetch("https://cybertizeweb.com/cms/studyfocus/cybertechMedia/api/new-study-api/city/city_fetchAll.php?state=" + state);
        const city = await res.json();

        setCity(city);
    }

    const getUser = () => {
        var username = localStorage.getItem('user_name');
        return username;
    }

    const scrollTop = () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    };

    useEffect(() => {
        scrollTop();
        var name = getUser();
        dispatch(getInitialSignup());
        if (name != null) {
            Router.push('/');
        }
    }, []);

    const userSignup = (e) => {
        e.preventDefault();

        const formData = new FormData();
        formData.append('name', name);
        formData.append('email', email);
        formData.append('password', password);
        formData.append('subject', subject);
        formData.append('experience', experience);
        formData.append('feerange', feerange);
        // formData.append('feemax', feemax);
        formData.append('medium', medium);
        formData.append('mobile', mobile);
        formData.append('profile', selectedFile);
        formData.append('state', state);
        formData.append('scity', scity);
        formData.append('cls', cls);
        formData.append('platform', platform);
        formData.append('board', board);
        formData.append('description', description);

        // console.log(formData);
        // return false;
        axios.post('https://cms.cybertizeweb.com/studyfocus/cybertechMedia/api/new-study-api/register/agency-api.php', formData)
            .then(function (response) {
                //handle success
                console.log("success");
                if (response.data.status) {
                    alert('Successfully SignUp Please Sign in now...');
                    Router.push('/signin');
                }

            })
            .catch(function (response) {
                //handle error
                console.log(response)
                console.log("sorry")
            });

        setType('');
        setName('');
        setEmail('');
        setExperience('');
        // setFeemax('');
        setFeerange('');
        setProfile('');
        setPassword('');
        setMobile('');
        setSubject([]);
        setMedium([]);
        setCls([]);
        setBoard([]);
        setPlatform([]);
        setState('');
        setCity([]);
        setSCity('');
    }



    const handleCity = (state) => {
        setState(state);
        getCity(state);
    }

    const renderStep1 = () => {
        return (
            <>
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
                    <h5>Work email</h5>
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
                    <h5>Password</h5>
                    <div className="sign__input">
                        <input
                            type="password"
                            required
                            placeholder="Password"
                            value={password}
                            onChange={(e) => { setPassword(e.target.value) }}
                        />
                        <i className="fal fa-lock"></i>
                    </div>
                </div>

                <div className="sign__input-wrapper mb-25">
                    <h5>Enter Mobile No</h5>
                    <div className="sign__input">
                        <input
                            type="text"
                            required
                            minLength='10'
                            maxLength='10'
                            placeholder="Enter Mobile No"
                            value={mobile}
                            onChange={(e) => { setMobile(e.target.value) }}
                        />
                        <i className="fal fa-mobile"></i>
                    </div>
                </div>

                <div className="sign__input-wrapper mb-25">
                    <h5>Enter Teaching Experience</h5>
                    <div className="sign__input">
                        <input
                            type="number"
                            required
                            placeholder="Enter Experience in Year"
                            value={experience}
                            onChange={(e) => { setExperience(e.target.value) }}
                        />
                        <i className="fal fa-calendar"></i>
                    </div>
                </div>

                <div className="sign__input-wrapper mb-25">
                    <h5>Upload Profile Pic</h5>
                    <p>Profile Photo make you stand out and get more enquires</p>
                    <input type="file" name="file" onChange={changeHandler} />
                </div>
                {/* {isSelected ? (
                    <div>
                        <p>Filename: {selectedFile.name}</p>
                        <p>Filetype: {selectedFile.type}</p>
                        <p>Size in bytes: {selectedFile.size}</p>
                        <p>
                            lastModifiedDate:{' '}
                            {selectedFile.lastModifiedDate.toLocaleDateString()}
                        </p>
                    </div>
                ) : (
                    <p>Select a file to show details</p>
                )} */}
                <button onClick={validateForm1} className="e-btn w-100">Continue</button>
            </>
        )
    }
    const validateForm1 = (e) => {
        scrollTop();
        e.preventDefault();
        if (name == "" || email == "" || password == "" || mobile == "" || experience == "" || isSelected == false) {
            alert('Please Enter all the Fields');
        } else if (mobile.length != 10) {
            alert('Mobile number should be of 10 digits');
        }
        else {
            setStep2('1');
            setStep1('0');
            setHeadtext("Almost There, Just a few more details");
        }


    }

    const renderStep2 = () => {
        return (
            <>
                <div className="sign__input-wrapper mb-25">
                    <h5>Select State</h5>
                    <Form.Group as={Col} >
                        <Form.Control as="select" value={state} onChange={(e) => { handleCity(e.target.value); }} >
                            {
                                initialSignupData.states && initialSignupData.states.length > 0 ? initialSignupData.states.map(state =>

                                    <option value={state.id}>{state.name}</option>

                                ) : ""
                            }
                        </Form.Control>
                    </Form.Group>
                </div>

                <div className="sign__input-wrapper mb-25">
                    <h5>Select City</h5>
                    <Form.Group as={Col} >
                        <Form.Control as="select" value={scity} onChange={(e) => { setSCity(e.target.value); }} >
                            <option value="0">Select State First</option>

                            {
                                city.data && city.data.length > 0 ? city.data.map(cit =>

                                    <option value={cit.id}>{cit.name}</option>

                                ) : ""
                            }
                        </Form.Control>
                    </Form.Group>
                </div>

                <div className="sign__input-wrapper mb-25">
                    <h5>Select Class
                    <p>Press Ctrl & Click to select multiple items</p>

                    </h5>
                    <Form.Group as={Col} controlId="multiselect_cls">
                        <Form.Control as="select" multiple value={cls} onChange={e => setCls([].slice.call(e.target.selectedOptions).map(item => item.value))}>
                            {
                                initialSignupData.cls && initialSignupData.cls.length > 0 ? initialSignupData.cls.map(cls =>

                                    <option value={cls.class_name}>{cls.class_name}</option>

                                ) : ""
                            }
                        </Form.Control>
                    </Form.Group>
                </div>

                <div className="sign__input-wrapper mb-25">
                    <h5>Select Subjects
                    <p>Press Ctrl & Click to select multiple items</p>

                    </h5>
                    <Form.Group as={Col} controlId="multiselect_subject">
                        <Form.Control as="select" multiple value={subject} onChange={e => setSubject([].slice.call(e.target.selectedOptions).map(item => item.value))}>
                            {
                                initialSignupData.subjects && initialSignupData.subjects.length > 0 ? initialSignupData.subjects.map(subject =>

                                    <option value={subject.subject_name}>{subject.subject_name}</option>

                                ) : ""
                            }
                        </Form.Control>
                    </Form.Group>
                </div>
                <div className="sign__input-wrapper mb-25">
                    <h5>Select Medium</h5>
                    <Form.Group as={Col} controlId="multiselect_medium">
                        <Form.Control as="select" multiple value={medium} onChange={e => setMedium([].slice.call(e.target.selectedOptions).map(item => item.value))}>
                            {
                                initialSignupData.medium && initialSignupData.medium.length > 0 ? initialSignupData.medium.map(medium =>

                                    <option value={medium.medium}>{medium.medium}</option>

                                ) : ""
                            }
                        </Form.Control>
                    </Form.Group>
                </div>
                <div className="sign__input-wrapper mb-25">
                    <h5>Select Board</h5>
                    <Form.Group as={Col} controlId="multiselect_board">
                        <Form.Control as="select" multiple value={board} onChange={e => setBoard([].slice.call(e.target.selectedOptions).map(item => item.value))}>
                            {
                                initialSignupData.board && initialSignupData.board.length > 0 ? initialSignupData.board.map(board =>

                                    <option value={board.board_name}>{board.board_name}</option>

                                ) : ""
                            }
                        </Form.Control>
                    </Form.Group>
                </div>
                <button onClick={validateForm2} className="e-btn w-100">Continue</button>

            </>
        )
    }

    const validateForm2 = (e) => {
        scrollTop();
        e.preventDefault();
        if (state == "" || scity == "" || cls == "" || subject == "" || medium == "" || board == "") {
            alert('Please Enter all the Fields');
        }
        else {
            setStep3('1');
            setStep2('0');
            setStep2('0');
            setHeadtext("Help Students know you're institute better");
        }

    }

    const renderStep3 = () => {
        return (
            <>
                <div className="sign__input-wrapper mb-25">
                    <h5>Enter Min Fee</h5>
                    <div className="sign__input">
                        <input
                            type="text"
                            required
                            placeholder="Ex 500 - 1000"
                            value={feerange}
                            onChange={(e) => { setFeerange(e.target.value) }}
                        />
                        <i className="fal fa-user"></i>
                    </div>
                </div>
                {/* <div className="sign__input-wrapper mb-25">
                    <h5>Enter Max Fee</h5>
                    <div className="sign__input">
                        <input
                            type="number"
                            required
                            placeholder="Enter max fee"
                            value={feemax}
                            onChange={(e) => { setFeemax(e.target.value) }}
                        />
                        <i className="fal fa-user"></i>
                    </div>
                </div> */}
                <div className="sign__input-wrapper mb-25">
                    <h5>Select Platform</h5>
                    <Form.Group as={Col} controlId="multiselect_platform">
                        <Form.Control as="select" multiple value={platform} onChange={e => setPlatform([].slice.call(e.target.selectedOptions).map(item => item.value))}>
                            {
                                initialSignupData.platform && initialSignupData.platform.length > 0 ? initialSignupData.platform.map(platform =>

                                    <option value={platform.teach_platform}>{platform.teach_platform}</option>

                                ) : ""
                            }
                        </Form.Control>
                    </Form.Group>
                </div>
                <div className="sign__input-wrapper mb-25">
                    <h5>Write Description in 150 words</h5>
                    <Form.Group as={Col} >
                        <Form.Control
                            as="textarea"
                            placeholder="Write about yourself"
                            style={{ height: '100px' }}
                            onChange={(e) => { setDescription(e.target.value) }}

                        />
                    </Form.Group>
                </div>
                <div className="sign__action d-flex justify-content-between mb-30">
                    <div className="sign__agree d-flex align-items-center">
                        <input className="m-check-input" required type="checkbox" id="m-agree" />
                        <label className="m-check-label" for="m-agree">I agree to the <a href="#">Terms &
                                            Conditions</a>
                        </label>
                    </div>
                </div>
                <button className="e-btn w-100" type="submit">Sign Up</button>
                <div className="sign__new text-center mt-20">
                    <p>Already Signed Up ? <Link href="/signin"> Sign In</Link></p>
                </div>
            </>
        )
    }



    const renderSignUp = () => {
        return (
            <div className="sign__form" method='POST'>
                <form onSubmit={userSignup}>
                    {step1 == '1' ? renderStep1() : ''}

                    {step2 == '1' ? renderStep2() : ''}

                    {step3 == '1' ? renderStep3() : ''}

                </form>
            </div>
        )
    }


    return (
        <>
            <section className="signup__area po-rel-z1 pt-100 pb-145">
                <div className="sign__shape">
                    <img className="man-1" src="/assets/img/icon/sign/man-3.png" alt="" />
                    <img className="man-2 man-22" src="/assets/img/icon/sign/man-2.png" alt="" />
                    <img className="circle" src="/assets/img/icon/sign/circle.png" alt="" />
                    <img className="zigzag" src="/assets/img/icon/sign/zigzag.png" alt="" />
                    <img className="dot" src="/assets/img/icon/sign/dot.png" alt="" />
                    <img className="bg" src="/assets/img/icon/sign/sign-up.png" alt="" />
                    <img className="flower" src="/assets/img/icon/sign/flower.png" alt="" />
                </div>
                <div className="container">
                    <div className="row">
                        <div className="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2">
                            <div className="section__title-wrapper text-center mb-55">
                                <h2 className="section__title">{headtext}</h2>
                            </div>
                        </div>
                    </div>
                    <div className="row">
                        <div className="col-xxl-6 offset-xxl-3 col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                            <div className="sign__wrapper white-bg">
                                {/* <div className="sign__header mb-35">
                                    <div className="sign__in text-center">
                                        <a href="#" className="sign__social g-plus text-start mb-15"><i
                                            className="fab fa-google-plus-g"></i>Sign Up with Google</a>
                                        <p> <span>........</span> Or, <a href="sign-up.html">sign up</a> with your email<span>
                                            ........</span> </p>
                                    </div>
                                </div> */}
                                {
                                    renderSignUp()
                                }
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </>
    )
}