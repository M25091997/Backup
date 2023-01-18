import React, { useEffect, useState } from 'react'
import Link from 'next/link';
import Router from 'next/router';
import { getSearchTutorAgency, getStateSubjectData, getInitialCityData } from '../../../../redux/actions';
import { useDispatch, useSelector } from 'react-redux';
import Notification from './Notification';
import { base_url, base_url_tutor } from '../../../../helpers/urlConfig';
import { Modal, Button, Col, Form } from 'react-bootstrap';


export default function Layout() {
    const dispatch = useDispatch();

    const [show, setShow] = useState(false);
    const [user, setUser] = useState(null);
    const [search, setSearch] = useState('');

    const handleClose = () => setShow(false);
    const handleShow = () => setShow(true);
    const [state, setState] = useState('');
    const [localCityId, setlocalCityId] = useState('0');
    const [localCityName, setlocalCityName] = useState('Select City');

    const [city, setCity] = useState([]);
    const [scity, setSCity] = useState('');
    const initialSignupData = useSelector(state => state.initialSignupData);

    const checkcity = () => {
        (localStorage.getItem('localCity') == null || localStorage.getItem('localCity') == '') ? localStorage.setItem('localCity', 0) : "";
        (localStorage.getItem('localCityName') == null || localStorage.getItem('localCityName') == '') ? "" : setlocalCityName(localStorage.getItem('localCityName'));

        setlocalCityId(localStorage.getItem('localCity'));

    }
    const cityModalManager = () => {
        (localStorage.getItem('localCity') != 0 || localStorage.getItem('localCity') == null) ? handleClose() : handleShow();
    }
    const getUser = () => {
        var username = localStorage.getItem('user_name');
        return username;
    }
    // useEffect(() => {
    //     var name = getUser();
    //     if (name != null) {
    //         setUser(name);
    //     }

    // }, [user]);

    useEffect(() => {
        dispatch(getStateSubjectData());
        cityModalManager();
        checkcity();
        var name = getUser();
        if (name != null) {
            setUser(name);
        }
    }, [user]);

    // we will use async/await to fetch this data
    async function getCity(state) {
        const res = await fetch("https://studyfocus.in/cybertechMedia/api/new-study-api/city/city_fetchAll.php?state=" + state);
        const city = await res.json();

        setCity(city);
    }
    const handleCity = (state) => {
        setState(state);
        getCity(state);
    }

    const handleSingleCity = (e) => {
        let singlecityvalue = e.target.value;
        setSCity(e.target.value);
        let city_id = singlecityvalue.split(",")['0'];
        console.log(city_id);

        localStorage.setItem('localCity', city_id);
        let city_name = singlecityvalue.split(",")['1'];
        localStorage.setItem('localCityName', city_name);
        setlocalCityName(localStorage.getItem('localCityName'));
        setlocalCityId(localStorage.getItem('localCity'));

    }

    const getCityValue = () => {
        let get_city_name = localStorage.getItem('localCityName');
        let current_url = window.location.href;
        if( current_url != base_url){
            Router.push(get_city_name);
        }  
        const cityDataId = {
            localCityId
        }
        dispatch(getInitialCityData(cityDataId));
        handleClose();
    }

    const cityModal = () => {
        return (
            <div className="container">
                <div className="row">
                    <div className="col-md-12 bg-light">
                        <div className="row">
                            <div className="col-md-12 card-body">

                                <div className="row">
                                    <div className="col-md-6">
                                        <div className="sign__input-wrapper mb-25">
                                            <h5>Select State</h5>
                                            <Form.Group as={Col} >
                                                <Form.Control as="select" value={state} onChange={(e) => { handleCity(e.target.value); }} >
                                                    <option value="">Select State</option>
                                                    {
                                                        initialSignupData.states && initialSignupData.states.length > 0 ? initialSignupData.states.map(state =>

                                                            <option value={state.id}>{state.name}</option>

                                                        ) : ""
                                                    }
                                                </Form.Control>
                                            </Form.Group>
                                        </div>
                                    </div>
                                    <div className="col-md-6">
                                        <div className="sign__input-wrapper mb-25">
                                            <h5>Select City</h5>
                                            <Form.Group as={Col} >
                                                <Form.Control as="select" value={scity} onChange={(e) => { handleSingleCity(e) }} >
                                                    <option value="">Select City</option>
                                                    {
                                                        city.data && city.data.length > 0 ? city.data.map(cit =>

                                                            <option value={cit.id + ',' + cit.name}>{cit.name}</option>

                                                        ) : ""
                                                    }
                                                </Form.Control>
                                            </Form.Group>
                                        </div>
                                    </div>
                                </div>


                                <div className="row">
                                    <div className="col-md-12">
                                        <p> POPULAR CITIES</p>
                                    </div>
                                </div>
                                <div className="row">
                                    <div className="col-md-3">
                                        <button type="button" className="btn btn-link" style={{ fontSize: "10px", color: "#1a1a1a" }} > <i class="fa fa-map-marker" aria-hidden="true"></i> New Delhi</button></div>
                                    <div className="col-md-3">
                                        <button type="button" className="btn btn-link" style={{ fontSize: "10px", color: "#1a1a1a" }} > <i class="fa fa-map-marker" aria-hidden="true"></i> Chennai</button></div>
                                    <div className="col-md-3">
                                        <button type="button" className="btn btn-link" style={{ fontSize: "10px", color: "#1a1a1a" }} > <i class="fa fa-map-marker" aria-hidden="true"></i> Banglore</button></div>
                                    <div className="col-md-3">
                                        <button type="button" className="btn btn-link" style={{ fontSize: "10px", color: "#1a1a1a" }} > <i class="fa fa-map-marker" aria-hidden="true"></i> Jaipur</button></div>
                                    <div className="col-md-3">
                                        <button type="button" className="btn btn-link" style={{ fontSize: "10px", color: "#1a1a1a" }} > <i class="fa fa-map-marker" aria-hidden="true"></i> Mumbai</button></div>
                                    <div className="col-md-3">
                                        <button type="button" className="btn btn-link" style={{ fontSize: "10px", color: "#1a1a1a" }} > <i class="fa fa-map-marker" aria-hidden="true"></i> Kanpur</button></div>
                                    <div className="col-md-3">
                                        <button type="button" className="btn btn-link" style={{ fontSize: "10px", color: "#1a1a1a" }} > <i class="fa fa-map-marker" aria-hidden="true"></i> Kochi</button></div>
                                    <div className="col-md-3">
                                        <button type="button" className="btn btn-link" style={{ fontSize: "10px", color: "#1a1a1a" }} > <i class="fa fa-map-marker" aria-hidden="true"></i> Kolkata</button></div>
                                    <div className="col-md-3">
                                        <button type="button" className="btn btn-link" style={{ fontSize: "10px", color: "#1a1a1a" }} > <i class="fa fa-map-marker" aria-hidden="true"></i> Pune</button></div>
                                    <div className="col-md-3">
                                        <button type="button" className="btn btn-link" style={{ fontSize: "10px", color: "#1a1a1a" }} > <i class="fa fa-map-marker" aria-hidden="true"></i> Patna</button>
                                    </div>
                                    <div className="col-md-3">
                                        <button type="button" className="btn btn-link" style={{ fontSize: "10px", color: "#1a1a1a" }} > <i class="fa fa-map-marker" aria-hidden="true"></i> Surat</button></div>

                                    <div className="col-md-3">
                                        <button type="button" className="btn btn-link" style={{ fontSize: "10px", color: "#1a1a1a" }} > <i class="fa fa-map-marker" aria-hidden="true"></i> Nagpur</button></div>
                                    <div className="col-md-3">
                                        <button type="button" className="btn btn-link" style={{ fontSize: "10px", color: "#1a1a1a" }} > <i class="fa fa-map-marker" aria-hidden="true"></i> Hydrabad</button></div>
                                    <div className="col-md-4">
                                        <button type="button" className="btn btn-link" style={{ fontSize: "10px", color: "#1a1a1a" }} > <i class="fa fa-map-marker" aria-hidden="true"></i> Bhubaneswar</button></div>


                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        )

    }


    

    

    const renderSignIn = () => {
        return (
            <>
                <li><Link href="/signup-tutor">As Tutor</Link></li>
                <li><Link href="/signup-institute">As Institute</Link></li>
                <li><Link href="/signup-councellor">As Councellor</Link></li>

            </>
        );
    }
    const renderSignInMobile = () => {
        return (
            <>
                <li style={{ color: '#000', borderBottom: '1px solid #bbbcbf', padding: '10px', fontSize: '15px', fontWeight: '600' }}><Link href="/signin">Sign In</Link></li>
                <li style={{ color: '#000', borderBottom: '1px solid #bbbcbf', padding: '10px', fontSize: '15px', fontWeight: '600' }}><Link href="/signup">Sign Up</Link></li>
            </>
        );
    }
    const logOut = () => {
        localStorage.clear();
        setUser(null);
        // location.reload();
    }
    const renderLogoutMobile = () => {
        return (
            <li style={{ color: '#000', borderBottom: '1px solid #bbbcbf', padding: '10px', fontSize: '15px', fontWeight: '600' }} onClick={() => logOut()}><Link href="">LogOut</Link></li>
        );
    }
    const renderLogout = () => {
        return (
            <li onClick={() => logOut()}><Link href="">LogOut</Link></li>
        );
    }

    const renderLogOutBut = () => {
        return (
            <button className="login">
                <Link href="/signin">login</Link>
            </button>
        );
    }
    const renderLoginBut = (name) => {
        return (
            <div className="main-menu">
                <ul>
                    <li className="has-dropdown">
                        <span>Hi, {name}</span>
                        <ul className="submenu">
                            <li><Link href="/my-account">My Account</Link></li>
                            <li onClick={() => logOut()}><Link href="">Logout</Link></li>
                        </ul>
                    </li>
                </ul>
            </div>
        );
    }


    const searchKey = (e) => {
        e.preventDefault();
        const searchkey = {
            search
        }
        dispatch(getSearchTutorAgency(searchkey));
    }
    const runSearch = (e) => {
        e.preventDefault();
        const searchkey = {
            search
        }
        if (e.keyCode == 13) {
            dispatch(getSearchTutorAgency(searchkey));

        }

    }

    const genLinkUrl = () => {
        return base_url_tutor+`${localCityName}`;
    }

    return (
        <div>

            <header>
                <div id="header-sticky" className="header__area header__transparent header__padding" style={{ background: '#fff' }}>
                    <div className="container-fluid">
                        <div className="row align-items-center">
                            <div className="col-xxl-3 col-xl-3 col-lg-4 col-md-2 col-sm-4 col-6">
                                <div className="header__left d-flex">
                                    <div className="logo">
                                        <Link href="/">
                                            <img src={base_url + "/assets/img/logo/logo.png"} alt="logo" />
                                        </Link>
                                    </div>
                                    <div className="header__category d-none d-lg-block">
                                        <nav>
                                            <ul>
                                                <li>
                                                    <a href="course-grid.html" className="cat-menu d-flex align-items-center">
                                                        <div className="cat-dot-icon d-inline-block">
                                                            <svg viewBox="0 0 276.2 276.2">
                                                                <g>
                                                                    <g>
                                                                        <path className="cat-dot" d="M33.1,2.5C15.3,2.5,0.9,17,0.9,34.8s14.5,32.3,32.3,32.3s32.3-14.5,32.3-32.3S51,2.5,33.1,2.5z" />
                                                                        <path className="cat-dot" d="M137.7,2.5c-17.8,0-32.3,14.5-32.3,32.3s14.5,32.3,32.3,32.3c17.8,0,32.3-14.5,32.3-32.3S155.5,2.5,137.7,2.5    z" />
                                                                        <path className="cat-dot" d="M243.9,67.1c17.8,0,32.3-14.5,32.3-32.3S261.7,2.5,243.9,2.5S211.6,17,211.6,34.8S226.1,67.1,243.9,67.1z" />
                                                                        <path className="cat-dot" d="M32.3,170.5c17.8,0,32.3-14.5,32.3-32.3c0-17.8-14.5-32.3-32.3-32.3S0,120.4,0,138.2S14.5,170.5,32.3,170.5z" />
                                                                        <path className="cat-dot" d="M136.8,170.5c17.8,0,32.3-14.5,32.3-32.3c0-17.8-14.5-32.3-32.3-32.3c-17.8,0-32.3,14.5-32.3,32.3    C104.5,156.1,119,170.5,136.8,170.5z" />
                                                                        <path className="cat-dot" d="M243,170.5c17.8,0,32.3-14.5,32.3-32.3c0-17.8-14.5-32.3-32.3-32.3s-32.3,14.5-32.3,32.3    C210.7,156.1,225.2,170.5,243,170.5z" />
                                                                        <path className="cat-dot" d="M33,209.1c-17.8,0-32.3,14.5-32.3,32.3c0,17.8,14.5,32.3,32.3,32.3s32.3-14.5,32.3-32.3S50.8,209.1,33,209.1z    " />
                                                                        <path className="cat-dot" d="M137.6,209.1c-17.8,0-32.3,14.5-32.3,32.3c0,17.8,14.5,32.3,32.3,32.3c17.8,0,32.3-14.5,32.3-32.3    S155.4,209.1,137.6,209.1z" />
                                                                        <path className="cat-dot" d="M243.8,209.1c-17.8,0-32.3,14.5-32.3,32.3c0,17.8,14.5,32.3,32.3,32.3c17.8,0,32.3-14.5,32.3-32.3    S261.6,209.1,243.8,209.1z" />
                                                                    </g>
                                                                </g>
                                                            </svg>
                                                        </div>
                                                        <span>Category</span>
                                                    </a>
                                                    <ul className="cat-submenu">
                                                        <li><Link href="/tutors">Tutors</Link></li>
                                                        <li><Link href="/institutes">Institutes</Link></li>
                                                        <li><Link href="/institutes">Councellors</Link></li>
                                                        <li><Link href="/blog">Library</Link></li>
                                                        <li><Link href="/about">About Us</Link></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <div className="col-xxl-9 col-xl-9 col-lg-8 col-md-10 col-sm-8 col-6">
                                <div className="header__right d-flex justify-content-end align-items-center">
                                    <div className="main-menu">
                                        <nav id="mobile-menu">
                                            <ul>
                                                <li className="">
                                                    <Button variant="primary" onClick={handleShow} style={{ fontSize: "10px" }}>
                                                        <i class="fa fa-map-marker" aria-hidden="true" style={{ marginRight: "5px" }}></i> {localCityName}
                                                    </Button>
                                                </li>

                                                <li className="has-dropdown">
                                                    <Link href="/">Find</Link>
                                                    <ul className="submenu">
                                                        <li><Link href={genLinkUrl()}>Tutors</Link></li>
                                                        <li><Link href="/institutes">Institutes</Link></li>
                                                        <li><Link href="/view-all-councellors">Councellors</Link></li>

                                                    </ul>
                                                </li>
                                                <li className="">
                                                    <Link href="/">Advertise</Link>
                                                </li>
                                                <li className="">
                                                    <Link href="/blog">Library</Link>
                                                </li>

                                                <li className="has-dropdown">
                                                    <Link href="/">Join</Link>
                                                    <ul className="submenu">
                                                        {
                                                            user === null ? renderSignIn() : renderLogout()
                                                            // console.log(user)
                                                        }
                                                    </ul>
                                                </li>
                                                <li className="">
                                                    <Link href="/contact">Contact</Link>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                    <div className="header__search p-relative ml-50 d-none d-md-block">
                                        <form onSubmit={searchKey}>
                                            <input
                                                type="text"
                                                style={{ background: '#e9e9e9' }}
                                                placeholder="Search Teachers, Institutes"
                                                onKeyUp={runSearch}
                                                value={search}
                                                onChange={(e) => { setSearch(e.target.value) }}
                                            />
                                            <button type="submit"><i className="fad fa-search"></i></button>
                                        </form>
                                        <div className="header__cart">
                                            <a onClick={(e) => e.preventDefault()} className="cart-toggle-btn">
                                                <div className="header__cart-icon">
                                                    <img src="assets/img/logo/notification.png" alt="logo" />

                                                </div>
                                                <span className="cart-item">2</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div className="header__btn ml-20 d-none d-sm-block">
                                        {user != null ? renderLoginBut(user) : renderLogOutBut()}

                                    </div>
                                    <div className="sidebar__menu d-xl-none">
                                        <div className="sidebar-toggle-btn ml-30" id="sidebar-toggle">
                                            <span className="line"></span>
                                            <span className="line"></span>
                                            <span className="line"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <Notification />

            <div className="body-overlay"></div>
            <div className="sidebar__area">
                <div className="sidebar__wrapper">
                    <div className="sidebar__close">
                        <button className="sidebar__close-btn" id="sidebar__close-btn">
                            <span><i className="fal fa-times"></i></span>
                            <span>close</span>
                        </button>
                    </div>
                    <div className="sidebar__content">
                        <div className="logo mb-40">
                            <a href="index-2.html">
                                <img src="/assets/img/logo/logo.png" alt="logo" />
                            </a>
                        </div>
                        <div className="">
                            <nav>
                                <ul>
                                    <li className="" style={{ color: '#000', borderBottom: '1px solid #bbbcbf', padding: '10px', fontSize: '15px', fontWeight: '600' }}>
                                        <Link href="/">Home</Link>
                                    </li>

                                    <li style={{ color: '#000', borderBottom: '1px solid #bbbcbf', padding: '10px', fontSize: '15px', fontWeight: '600' }}><Link href="/tutors">Tutors</Link></li>
                                    <li style={{ color: '#000', borderBottom: '1px solid #bbbcbf', padding: '10px', fontSize: '15px', fontWeight: '600' }}><Link href="/institutes">Institutes</Link></li>

                                    <li className="" style={{ color: '#000', borderBottom: '1px solid #bbbcbf', padding: '10px', fontSize: '15px', fontWeight: '600' }}>
                                        <Link href="/">Advertise</Link>
                                    </li>
                                    <li className="" style={{ color: '#000', borderBottom: '1px solid #bbbcbf', padding: '10px', fontSize: '15px', fontWeight: '600' }}>
                                        <Link href="/blog">Library</Link>
                                    </li>
                                    <li className="" style={{ color: '#000', borderBottom: '1px solid #bbbcbf', padding: '10px', fontSize: '15px', fontWeight: '600' }}>
                                        <Link href="/contact">Contact</Link>
                                    </li>

                                    {
                                        user === null ? renderSignInMobile() : renderLogoutMobile()
                                        // console.log(user)
                                    }

                                </ul>
                            </nav>
                        </div>

                        <div className="sidebar__search p-relative mt-40 ">
                            <form onSubmit={searchKey}>
                                <input
                                    type="text"
                                    placeholder="Search tutors,institutes and subjects..."
                                    onKeyUp={runSearch}
                                    value={search}
                                    onChange={(e) => { setSearch(e.target.value) }}
                                />
                                <button type="submit"><i className="fad fa-search"></i></button>
                            </form>
                        </div>
                        <div className="sidebar__cart mt-30">
                            <a href="#">
                                <div className="header__cart-icon">
                                    <svg viewBox="0 0 24 24">
                                        <circle className="st0" cx="9" cy="21" r="1" />
                                        <circle className="st0" cx="20" cy="21" r="1" />
                                        <path className="st0" d="M1,1h4l2.7,13.4c0.2,1,1,1.6,2,1.6h9.7c1,0,1.8-0.7,2-1.6L23,6H6" />
                                    </svg>
                                </div>
                                <span className="cart-item">2</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div className="body-overlay"></div>
            <Modal
                show={show}
                onHide={handleClose}
                backdrop="static"
                keyboard={false}
            >
                <Modal.Header closeButton>
                    <Modal.Title>Location</Modal.Title>
                </Modal.Header>
                <Modal.Body>
                    {cityModal()}
                </Modal.Body>
                <Modal.Footer>
                    <Button variant="secondary" onClick={handleClose}>
                        Close
                    </Button>
                    <Button variant="primary" onClick={getCityValue}>Apply</Button>
                </Modal.Footer>
            </Modal>
        </div>
    )
}