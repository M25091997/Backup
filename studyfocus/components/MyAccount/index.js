import React, { useState, useEffect } from 'react';
import Link from 'next/link';
import { useDispatch, useSelector } from 'react-redux';
import { getTutorBySlug, getInitialSignup } from '../../redux/actions';
import Router from 'next/router';
import { Col, Form } from "react-bootstrap";
import axios from 'axios'
import { generatePublicUrl, base_url, api } from '../../helpers/urlConfig';
import router from 'next/router';



export default function MyAccount() {
    const dispatch = useDispatch();
    const initialSignupData = useSelector(state => state.initialSignupData);
    const tutorData = useSelector(state => state.getTutorBySlug);

    const [name, setName] = useState(tutorData.tutor.name);
    const [qualification, setQualification] = useState('');
    const [university, setUniversity] = useState('');
    const [from, setFrom] = useState('');
    const [to, setTo] = useState('');
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [subject, setSubject] = useState([]);
    const [medium, setMedium] = useState([]);
    const [cls, setCls] = useState([]);
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
    const [step4, setStep4] = useState('');
    const [step5, setStep5] = useState('');
    const [selectedFile, setSelectedFile] = useState();
    const [isSelected, setIsSelected] = useState(false);
    const [profile, setProfile] = useState('');
    const [slug, setSlug] = useState('');
    const [feerange, setFeerange] = useState('');




    const changeHandler = (event) => {
        setSelectedFile(event.target.files[0]);
        setIsSelected(true);
    };


    


    // we will use async/await to fetch this data
    async function getCity(state) {
        const res = await fetch("https://cybertizeweb.com/cms/studyfocus/cybertechMedia/api/new-study-api/city/city_fetchAll.php?state=" + state);
        const city = await res.json();

        // console.log(city);
        // return false;
        // store the city into our city variable
        setCity(city);
    }

    const getUserId = () => {
        var userId = localStorage.getItem('user_id');
        return userId;
    }

    const scrollTop = () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    };

    useEffect( async () => {
        console.log(tutorData);
        console.log('useEffect Called');
        // return;
        tutorData.tutor && tutorData.tutor.length > 0 ? setName(tutorData.tutor[0].name) : setName('')
        tutorData.tutor && tutorData.tutor.length > 0 ? setEmail(tutorData.tutor[0].email) : setEmail('')
        tutorData.tutor && tutorData.tutor.length > 0 ? setMobile(tutorData.tutor[0].mobile) : setMobile('')
        tutorData.tutor && tutorData.tutor.length > 0 ? setPassword(tutorData.tutor[0].password) : setPassword('')
        tutorData.tutor && tutorData.tutor.length > 0 ? setFeerange(tutorData.tutor[0].fee_range) : setFeerange('')


            // tutorData.tutor.map(tutor =>
            // setName(tutorData.tutor[0].name),
            // setPassword(tutorData.tutor[0].password),
            // setEmail(tutorData.tutor[0].email),
            // setMobile(tutorData.tutor[0].mobile)
            // )
        

        scrollTop();
        var user_id = getUserId();
        if (user_id == null) {
            Router.push('/');
        }
        const tutor_id = {
            tut_id: user_id
        }
        await dispatch(getInitialSignup());
        await dispatch(getTutorBySlug(tutor_id));

    }, []);

    const logOut = () => {
        localStorage.clear();
        Router.push('/');
        // setUser(null);
        location.reload();
    }

    const userProfile = (e) => {

        e.preventDefault();
        const formData = new FormData();
        formData.append('tut_id', localStorage.getItem('user_id'));
        formData.append('name', name);
        formData.append('email', email);
        formData.append('password', password);
        formData.append('mobile', mobile);
        formData.append('profile', selectedFile);

        // console.log(formData);
        // return false;
        axios.post('https://cybertizeweb.com/cms/studyfocus/cybertechMedia/api/new-study-api/update/update-profile.php', formData)
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

        setName('');
        setEmail('');
        setProfile('');
        setPassword('');
        setMobile('');

    }

    const userSubject = (e) => {
        e.preventDefault();
        const formData = new FormData();
        formData.append('tut_id', localStorage.getItem('user_id'));
        formData.append('subject', subject);
        formData.append('medium', medium);
        formData.append('state', state);
        formData.append('scity', scity);
        formData.append('cls', cls);
        formData.append('board', board);
        // console.log(formData);
        // return false;
        axios.post('https://cybertizeweb.com/cms/studyfocus/cybertechMedia/api/new-study-api/update/update-subject.php', formData)
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

        setSubject([]);
        setMedium([]);
        setCls([]);
        setBoard([]);
        setState('');
        setCity([]);
        setSCity('');
    }

    const userDescription = (e) => {
        e.preventDefault();
        const formData = new FormData();
        formData.append('tut_id', localStorage.getItem('user_id'));
        formData.append('platform', platform);
        formData.append('description', description);
        formData.append('feerange', feerange);


        axios.post('https://cybertizeweb.com/cms/studyfocus/cybertechMedia/api/new-study-api/update/update-description.php', formData)
            .then(function (response) {
                //handle success
                console.log(response);
                if(response.data.status == 201){
                    alert('Successfully Updated');
                }
            })
            .catch(function (response) {
                //handle error
                console.log(response)
                console.log("sorry")
            });

        setPlatform('');
        setDescription('');
    }

    const userQualification = (e) => {
        e.preventDefault();
        const formData = new FormData();
        formData.append('tutor_id', localStorage.getItem('user_id'));
        formData.append('university', university);
        formData.append('qualification', qualification);
        formData.append('year_from', from);
        formData.append('place', to);
        // formData.append('year_to', to);


        axios.post('https://cybertizeweb.com/cms/studyfocus/cybertechMedia/api/new-study-api/update/add-qualification.php', formData)
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

        setQualification('');
        setUniversity('');
        setFrom('');
        setTo('');

    }

    const handleCity = (state) => {
        setState(state);
        getCity(state);
    }

    const renderStep1 = () => {
        return (
            <>
                {
                    tutorData.tutor && tutorData.tutor.length > 0 ?
                        tutorData.tutor.map(tutor =>
                            <>
                                <div className="sign__input-wrapper mb-25">
                                    <center>
                                        <div style={{
                                        height: '171px', width: '171px',
                                                            borderRadius: '100%',
                                                            backgroundSize: '100%',
                                                            backgroundPosition: 'center', 
                                                            backgroundRepeat: 'no-repeat',
                                                            backgroundImage: `url(${generatePublicUrl('newtutor/' + tutor.profile)})`  }}>

                                    </div>
                                    </center>
                                                    
                                 </div>
                                <div className="sign__input-wrapper mb-25">
                                    <h5>Full Name</h5>
                                    <div className="sign__input">
                                        <input
                                            type="text"
                                            placeholder="Enter Name"
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
                                            placeholder="Enter Email"
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
                                            placeholder="Enter Password"
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
                                            minLength="10"
                                            maxLength="10"
                                            required
                                            placeholder="Enter Mobile No"
                                            value={mobile}
                                            onChange={(e) => { setMobile(e.target.value) }}
                                        />
                                        <i className="fal fa-mobile"></i>
                                    </div>
                                </div>

                                <div className="sign__input-wrapper mb-25">
                                    <input type="file" name="file" onChange={changeHandler} />
                                </div>

                                <button className="e-btn w-100" type="submit">Update Profile</button>
                                <br/>
                                <button style={{
                                    marginTop: "10px", border: '2px solid red', background: '#fff',color: 'red'}} className="e-btn w-100" onClick={logOut}>LogOut</button>


                            </>
                        ) : null
                }
            </>
        )
    }

    const renderStep2 = () => {
        return (
            <>
                <div className="sign__input-wrapper mb-25">
                    <h5>Select State</h5>
                    <Form.Group as={Col} >
                        <Form.Control as="select" required value={state} onChange={(e) => { handleCity(e.target.value); }} >
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
                        <Form.Control as="select" required value={scity} onChange={(e) => { setSCity(e.target.value); }} >
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
                        <Form.Control as="select" required multiple value={cls} onChange={e => setCls([].slice.call(e.target.selectedOptions).map(item => item.value))}>
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
                        <Form.Control as="select" required multiple value={subject} onChange={e => setSubject([].slice.call(e.target.selectedOptions).map(item => item.value))}>
                            {
                                initialSignupData.subjects && initialSignupData.subjects.length > 0 ? initialSignupData.subjects.map(subject =>

                                    <option value={subject.subject_name}>{subject.subject_name}</option>

                                ) : ""
                            }
                        </Form.Control>
                    </Form.Group>
                </div>
                <div className="sign__input-wrapper mb-25">
                    <h5>Select Medium
                    <p>Press Ctrl & Click to select multiple items</p>
                    </h5>
                    <Form.Group as={Col} controlId="multiselect_medium">
                        <Form.Control as="select" required multiple value={medium} onChange={e => setMedium([].slice.call(e.target.selectedOptions).map(item => item.value))}>
                            {
                                initialSignupData.medium && initialSignupData.medium.length > 0 ? initialSignupData.medium.map(medium =>

                                    <option value={medium.medium}>{medium.medium}</option>

                                ) : ""
                            }
                        </Form.Control>
                    </Form.Group>
                </div>
                <div className="sign__input-wrapper mb-25">
                    <h5>Select Board
                    <p>Press Ctrl & Click to select multiple items</p>
                    </h5>
                    <Form.Group as={Col} controlId="multiselect_board">
                        <Form.Control as="select" required multiple value={board} onChange={e => setBoard([].slice.call(e.target.selectedOptions).map(item => item.value))}>
                            {
                                initialSignupData.board && initialSignupData.board.length > 0 ? initialSignupData.board.map(board =>

                                    <option value={board.board_name}>{board.board_name}</option>

                                ) : ""
                            }
                        </Form.Control>
                    </Form.Group>
                </div>
                <button className="e-btn w-100" type="submit">Update</button>

            </>
        )
    }

    const renderStep3 = () => {
        return (
            <>
                {
                    tutorData.tutor && tutorData.tutor.length > 0 ?
                        tutorData.tutor.map(tutor =>
                            <>
                                <div className="sign__input-wrapper mb-25">
                                    <h5>Enter your Tution Fee Range </h5>
                                    <div className="sign__input">
                                        <input
                                            type="text"
                                            required
                                            placeholder="Ex 500 - 1000"
                                            value={feerange}
                                            onChange={(e) => { setFeerange(e.target.value) }}
                                        />
                                        <i className="fal fa-inr"></i>
                                    </div>
                                </div>
                                <div className="sign__input-wrapper mb-25">
                                    <h5>Select Platform
                    <p>Press Ctrl & Click to select multiple items</p>
                                    </h5>
                                    <Form.Group as={Col} required controlId="multiselect_platform">
                                        <Form.Control as="select" required multiple value={platform} onChange={e => setPlatform([].slice.call(e.target.selectedOptions).map(item => item.value))}>
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
                                            placeholder={tutor.description}
                                            style={{ height: '100px' }}
                                            required
                                            onChange={(e) => { setDescription(e.target.value) }}

                                        />
                                    </Form.Group>
                                </div>

                                <button className="e-btn w-100" type="submit">Update Description</button>

                            </>
                        ) : null
                }
                
            </>
        )
    }

    const genUrl = (qId) => {
        return '/edit-qualification/' + qId;
    }

  

    const renderStep4 = (qual, univ, qual_id) => {
        return (
            <>
                <div className="sign__input-wrapper mb-25">
                    <h5>{qual} FROM {univ} <Link href={genUrl(qual_id)}><i style={{ color: '#000', marginLeft: '25px', cursor: 'pointer' }} class="fa fa-pencil" aria-hidden="true"></i></Link></h5>
                </div>
                
            </>
        )
    }

    const renderAddMoreQual = () => {
        return (
            <>
                <div className="sign__input-wrapper mb-25">
                    <button className="e-btn w-100" onClick={() => setStep5('1')}>Add More Qualification</button>
                </div>
            </>
        )
    }

    const renderStep41 = () => {
        return (
            <>
                <form onSubmit={userQualification}>
                <div className="sign__input-wrapper mb-25">
                    <h5>Enter Qualification</h5>
                    <div className="sign__input">
                        <input
                            type="text"
                            placeholder="Enter Qualification"
                            value={qualification}
                            required
                            onChange={(e) => { setQualification(e.target.value) }}
                        />
                        <i className="fal fa-user"></i>
                    </div>
                </div>

                <div className="sign__input-wrapper mb-25">
                    <h5>Enter University</h5>
                    <div className="sign__input">
                        <input
                            type="text"
                            placeholder="Enter University"
                            value={university}
                            required
                            onChange={(e) => { setUniversity(e.target.value) }}
                        />
                        <i className="fal fa-university"></i>
                    </div>
                </div>

                <div className="sign__input-wrapper mb-25">
                    <h5>Enter Year</h5>
                    <div className="sign__input">
                        <input
                            type="text"
                            placeholder="Enter Year(From)"
                            value={from}
                            required
                            onChange={(e) => { setFrom(e.target.value) }}
                        />
                        <i class="fa fa-calendar" aria-hidden="true"></i>
                    </div>
                </div>

                <div className="sign__input-wrapper mb-25">
                    <h5>Enter Place</h5>
                    <div className="sign__input">
                        <input
                            type="text"
                            placeholder="Enter Place"
                            value={to}
                            required
                            onChange={(e) => { setTo(e.target.value) }}
                        />
                        <i className="fa fa-globe"></i>
                    </div>
                </div>

                {/* <div className="sign__input-wrapper mb-25">
                    <h5>Enter Year(To)</h5>
                    <div className="sign__input">
                        <input
                            type="text"
                            placeholder="Enter Year(To)"
                            value={to}
                            required
                            onChange={(e) => { setTo(e.target.value) }}
                        />
                        <i className="fal fa-user"></i>
                    </div>
                </div> */}

                <button className="e-btn w-100" type="submit">Update Qualification</button>

            </form>
            </>
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
                                <h2 className="section__title">My Account</h2>
                                <p>Edit your information from here.</p>
                                <button style={{ margin: '2px', background: '#586fe5' }} onClick={e => { router.push('/student-enquiry') }} className="e-btn w-50" >Student Enquiry <i class="fa fa-pencil" aria-hidden="true"></i> </button>
                            </div>
                            <div className="row">
                                <div className="col-md-3">
                                    {
                                        step1 == 1 ? <button style={{ margin: '2px', background: '#586fe5' }} onClick={e => { setStep1('1'); setStep2('0'); setStep3('0'); setStep4('0') }} className="e-btn w-100" type="submit">Profile <i class="fa fa-pencil" aria-hidden="true"></i> </button> :
                                            <button style={{ margin: '2px' }} onClick={e => { setStep1('1'); setStep2('0'); setStep3('0'); setStep4('0') }} className="e-btn w-100" type="submit">Profile <i class="fa fa-pencil" aria-hidden="true"></i> </button>


                                    }
                                </div>
                                <div className="col-md-3">
                                    {
                                        step2 == 1 ? <button style={{ margin: '2px', background: '#586fe5' }} onClick={(e) => { setStep2('1'); setStep1('0'); setStep3('0'); setStep4('0') }} className="e-btn w-100" type="submit">Class/Subject <i class="fa fa-pencil" aria-hidden="true"></i> </button>
                                            : <button style={{ margin: '2px' }} onClick={(e) => { setStep2('1'); setStep1('0'); setStep3('0'); setStep4('0') }} className="e-btn w-100" type="submit">Class/Subject <i class="fa fa-pencil" aria-hidden="true"></i> </button>

                                    }
                                </div>
                                <div className="col-md-3">
                                    {
                                        step4 == 1 ? <button style={{ margin: '2px', background: '#586fe5' }} onClick={e => { setStep4('1'); setStep1('0'); setStep2('0'); setStep3('0') }} className="e-btn w-100" type="submit">Qualification <i class="fa fa-pencil" aria-hidden="true"></i> </button>
                                            : <button style={{ margin: '2px' }} onClick={e => { setStep4('1'); setStep1('0'); setStep2('0'); setStep3('0') }} className="e-btn w-100" type="submit">Qualification <i class="fa fa-pencil" aria-hidden="true"></i> </button>

                                    }
                                </div>
                                <div className="col-md-3">
                                    {
                                        step3 == 1 ? <button style={{ margin: '2px', background: '#586fe5' }} onClick={e => { setStep3('1'); setStep1('0'); setStep2('0'); setStep4('0') }} className="e-btn w-100" type="submit">Description <i class="fa fa-pencil" aria-hidden="true"></i> </button>
                                            : <button style={{ margin: '2px' }} onClick={e => { setStep3('1'); setStep1('0'); setStep2('0'); setStep4('0') }} className="e-btn w-100" type="submit">Description <i class="fa fa-pencil" aria-hidden="true"></i> </button>
                                    }
                                </div>

                            </div>
                        </div>
                    </div>
                    <br/>
                    <div className="row">
                        <div className="col-xxl-6 offset-xxl-3 col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">


                            <div className="sign__wrapper white-bg">

                                <br />
                                <div className="sign__form" method='POST'>

                                    <form onSubmit={userProfile}>
                                        {step1 == '1' ? renderStep1() : ''}
                                    </form>
                                    <form onSubmit={userSubject}>
                                        {step2 == '1' ? renderStep2() : ''}
                                    </form>
                                    {/* <form onSubmit={userQualification}> */}
                                        {/* {step4 == '1' ? renderStep4() : ''} */}
                                    {/* </form> */}
                                    {step4 == '1' ? <div>
                                        <h3>Existing Qualification</h3><hr/>
                                        {
                                            tutorData.qual && tutorData.qual.length > 0 ? tutorData.qual.map(qua =>
                                                renderStep4(qua.qualification, qua.university, qua.id)
                                            ) : <center><img width={'50%'} src={base_url + "/assets/img/logo/noq.jpeg"} alt="logo" /></center>
                                        }
                                        {renderAddMoreQual()}
                                    </div>: ""}
                                    

                                    

                                        {step5 == '1' ? renderStep41() : ''}

                                    
                                    <form onSubmit={userDescription}>
                                        {step3 == '1' ? renderStep3() : ''}
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