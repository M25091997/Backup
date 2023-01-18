import React, { useEffect, useState } from 'react'
import Link from 'next/link';
import Router from 'next/router';
import { getSearchTutorAgency, getStateSubjectData, getInitialCityData, getReduceCity } from '../../../../redux/actions';
import { useDispatch, useSelector } from 'react-redux';
import Notification from './Notification';
import { base_url, base_url_tutor, base_url_ins, base_url_counc } from '../../../../helpers/urlConfig';
import { Modal, Button, Col, Form } from 'react-bootstrap';


export default function Layout() {
    const dispatch = useDispatch();

    const [show, setShow] = useState(false);
    // const [user, setUser] = useState(null);
    const [customer, setCustomer] = useState('');
    const [customertype, setCustomerType] = useState('');


    const [search, setSearch] = useState('');

    const handleClose = () => setShow(false);
    const handleShow = () => setShow(true);
    const [state, setState] = useState('');
    const [localCityId, setlocalCityId] = useState('0');
    const [localCityName, setlocalCityName] = useState('Select City');

    const [city, setCity] = useState([]);
    const [scity, setSCity] = useState('');
    const initialSignupData = useSelector(state => state.initialSignupData);
    const reduceCityData = useSelector(state => state.reduceCityData);
    const user = useSelector(state => state.user);

    const checkcity = () => {
        (localStorage.getItem('localCity') == null || localStorage.getItem('localCity') == '') ? localStorage.setItem('localCity', 0) : "";
        (localStorage.getItem('localCityName') == null || localStorage.getItem('localCityName') == '') ? localStorage.setItem('localCityName', "Select City") : setlocalCityName(localStorage.getItem('localCityName'));

        setlocalCityId(localStorage.getItem('localCity'));

    }
    const cityModalManager = () => {
        let get_city_id = localStorage.getItem('localCity');
        (get_city_id == '0') ? handleShow() : handleClose();
    }

    const getUser = () => {
        var username = localStorage.getItem('user_name');
        return username;
    }
    const getUserType = () => {
        var usertype = localStorage.getItem('user_type');
        return usertype;
    }
    // useEffect(() => {
    //     var name = getUser();
    //     if (name != null) {
    //         setCustomer(name);
    //     }

    // }, [user]);

    useEffect(() => {
        checkcity();
        let get_city_id = localStorage.getItem('localCity');

        if (get_city_id == '0'){
            cityModalManager();
        }
        let get_city_name = localStorage.getItem('localCityName');
        const cityName = {
            get_city_name: get_city_name
        }
        dispatch(getReduceCity(cityName));
        dispatch(getStateSubjectData());

        var name = getUser();
        const type = getUserType();

        if (name != null) {
            setCustomer(name);
        }
        if (type != null) {
            setCustomerType(type);
        }
    }, [user.userId, customer, customertype]);

    // we will use async/await to fetch this data
    async function getCity(state) {
        const res = await fetch("https://cybertizeweb.com/cms/studyfocus/cybertechMedia/api/new-study-api/city/city_fetchAll.php?state=" + state);
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
        if (current_url != base_url) {
            Router.push(base_url + "tutors/" + get_city_name);
        }
        const cityDataId = {
            localCityId
        }
        const cityName = {
            get_city_name
        }
        dispatch(getInitialCityData(cityDataId));
        dispatch(getReduceCity(cityName));

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
                                                {/* <Form.Control as="select" className="apna-form-control" value={state} onChange={(e) => { handleCity(e.target.value); }} > */}
                                                    <select className="apna-form-control" style={{ height: "30px", lineHeight: "1", fontSize: "11px", fontWeight: "700", letterSpacing: "1px" }} value={state} onChange={(e) => { handleCity(e.target.value); }}>

                                                    <option value="">Select State</option>
                                                    {
                                                        initialSignupData.states && initialSignupData.states.length > 0 ? initialSignupData.states.map(state =>

                                                            <option value={state.id}>{state.name}</option>

                                                        ) : ""
                                                    }
                                                </select>
                                            </Form.Group>
                                        </div>
                                    </div>
                                    <div className="col-md-6">
                                        <div className="sign__input-wrapper mb-25">
                                            <h5>Select City</h5>
                                            <Form.Group as={Col} >
                                                {/* <Form.Control as="select" value={scity} onChange={(e) => { handleSingleCity(e) }} > */}
                                                <select className="apna-form-control" style={{ height: "30px", lineHeight: "1", fontSize: "11px", fontWeight: "700", letterSpacing: "1px" }} value={scity} onChange={(e) => { handleSingleCity(e) }}>

                                                    <option value="">Select City</option>
                                                    {
                                                        city.data && city.data.length > 0 ? city.data.map(cit =>

                                                            <option value={cit.id + ',' + cit.name}>{cit.name}</option>

                                                        ) : ""
                                                    }
                                                </select>
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
                                        <button type="button" className="btn btn-link" style={{ fontSize: "10px", color: "#1a1a1a" }} > <i class="fa fa-map-marker" aria-hidden="true"></i><Link href="tutors/Delhi">Delhi</Link></button></div>
                                    <div className="col-md-3">
                                        <button type="button" className="btn btn-link" style={{ fontSize: "10px", color: "#1a1a1a" }} > <i class="fa fa-map-marker" aria-hidden="true"></i><Link href="tutors/Chennai">Chennai</Link></button></div>
                                    <div className="col-md-3">
                                        <button type="button" className="btn btn-link" style={{ fontSize: "10px", color: "#1a1a1a" }} > <i class="fa fa-map-marker" aria-hidden="true"></i><Link href="tutors/Bengaluru">Bengaluru</Link></button></div>
                                    <div className="col-md-3">
                                        <button type="button" className="btn btn-link" style={{ fontSize: "10px", color: "#1a1a1a" }} > <i class="fa fa-map-marker" aria-hidden="true"></i><Link href="/tutors/Jaipur">Jaipur</Link> </button></div>
                                    <div className="col-md-3">
                                        <button type="button" className="btn btn-link" style={{ fontSize: "10px", color: "#1a1a1a" }} > <i class="fa fa-map-marker" aria-hidden="true"></i><Link href="/tutors/Mumbai">Mumbai</Link> </button></div>
                                    <div className="col-md-3">
                                        <button type="button" className="btn btn-link" style={{ fontSize: "10px", color: "#1a1a1a" }} > <i class="fa fa-map-marker" aria-hidden="true"></i><Link href="/tutors/Kanpur">Kanpur</Link></button></div>
                                    <div className="col-md-3">
                                        <button type="button" className="btn btn-link" style={{ fontSize: "10px", color: "#1a1a1a" }} > <i class="fa fa-map-marker" aria-hidden="true"></i><Link href="/tutors/Kochi">Kochi</Link></button></div>
                                    <div className="col-md-3">
                                        <button type="button" className="btn btn-link" style={{ fontSize: "10px", color: "#1a1a1a" }} > <i class="fa fa-map-marker" aria-hidden="true"></i><Link href="/tutors/Kolkata">Kolkata</Link></button></div>
                                    <div className="col-md-3">
                                        <button type="button" className="btn btn-link" style={{ fontSize: "10px", color: "#1a1a1a" }} > <i class="fa fa-map-marker" aria-hidden="true"></i><Link href="Pune">Pune</Link></button></div>
                                    <div className="col-md-3">
                                        <button type="button" className="btn btn-link" style={{ fontSize: "10px", color: "#1a1a1a" }} > <i class="fa fa-map-marker" aria-hidden="true"></i><Link href="Patna">Patna</Link> </button>
                                    </div>
                                    <div className="col-md-3">
                                        <button type="button" className="btn btn-link" style={{ fontSize: "10px", color: "#1a1a1a" }} > <i class="fa fa-map-marker" aria-hidden="true"></i><Link href="tutors/Surat">Surat</Link></button></div>

                                    <div className="col-md-3">
                                        <button type="button" className="btn btn-link" style={{ fontSize: "10px", color: "#1a1a1a" }} > <i class="fa fa-map-marker" aria-hidden="true"></i><Link href="tutors/Nagpur">Nagpur</Link></button></div>
                                    <div className="col-md-3">
                                        <button type="button" className="btn btn-link" style={{ fontSize: "10px", color: "#1a1a1a" }} > <i class="fa fa-map-marker" aria-hidden="true"></i><Link href="tutors/Hydrabad">Hydrabad</Link></button></div>
                                    <div className="col-md-4">
                                        <button type="button" className="btn btn-link" style={{ fontSize: "10px", color: "#1a1a1a" }} > <i class="fa fa-map-marker" aria-hidden="true"></i><Link href="tutors/Bhubaneswar">Bhubaneswar</Link></button></div>


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
                <li classname="side__cls-btn"><Link href="/signup-tutor">As Tutor</Link></li>
                <li classname="side__cls-btn"><Link href="/signup-institute">As Institute</Link></li>
                <li classname="side__cls-btn"><Link href="/signup-councellor">As Councellor</Link></li>

            </>
        );
    }
    const renderSignInMobile = () => {
        return (
            <>
                <li classname="side__cls-btn" style={{ color: '#000', borderBottom: '1px solid #bbbcbf', padding: '10px', fontSize: '15px', fontWeight: '600' }}><Link href="/signin">Log In</Link></li>
                <li classname="side__cls-btn" style={{ color: '#000', borderBottom: '1px solid #bbbcbf', padding: '10px', fontSize: '15px', fontWeight: '600' }}><Link href="/signup-tutor">Tutor Sign Up</Link></li>
                <li classname="side__cls-btn" style={{ color: '#000', borderBottom: '1px solid #bbbcbf', padding: '10px', fontSize: '15px', fontWeight: '600' }}><Link href="/signup-institute">Institute Sign Up</Link></li>
                <li classname="side__cls-btn" style={{ color: '#000', borderBottom: '1px solid #bbbcbf', padding: '10px', fontSize: '15px', fontWeight: '600' }}><Link href="/signup-councellor">Councellor Sign Up</Link></li>

            </>
        );
    }
    const logOut = () => {
        localStorage.clear();
        Router.push('/');
        // setUser(null);
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

    const renderLoginButMain = (cus_type) => {
        if(cus_type == 'tutor'){
            return (
                <button className="login">
                    <Link href="/my-account">{customer && customer.length < 7 ? 'Hi, ' + customer : 'Hi, ' + customer.substring(0, 7) + '...'}</Link>
                </button>
            );
        }
        if (cus_type == 'agency') {
            return (
                <button className="login">
                    <Link href="/my-account-institute">{customer && customer.length < 7 ? 'Hi, ' + customer : 'Hi, ' + customer.substring(0, 7) + '...'}</Link>
                </button>
            );
        } 
        if (cus_type == 'councellor') {
            return (
                <button className="login">
                    <Link href="/my-account-councellor">{customer && customer.length < 7 ? 'Hi, ' + customer : 'Hi, ' + customer.substring(0, 7) + '...'}</Link>
                </button>
            );
        }
    }

    // const renderLoginButTutor = () => {
    //     return (
    //         <button className="login">
    //             <Link href="/my-account">{customer && customer.length < 7 ? 'Hi, ' + customer : 'Hi, ' + customer.substring(0, 7) + '...'}</Link>
    //         </button>
    //     );
    // }

    // const renderLoginButIns = () => {
    //     return (
    //         <button className="login">
    //             <Link href="/my-account-councellor">{customer && customer.length < 7 ? 'Hi, ' + customer : 'Hi, ' + customer.substring(0, 7) + '...'}</Link>
    //         </button>
    //     );
    // }
    // const renderLoginButCounc = () => {
    //     return (
    //         <button className="login">
    //             <Link href="/my-account-institute">{customer && customer.length < 7 ? 'Hi, ' + customer : 'Hi, ' + customer.substring(0, 7) + '...'}</Link>
    //         </button>
    //     );
    // }
    // const renderLoginBut = () => {
    //     return (
    //         <div className="main-menu">
    //             <ul>
    //                 <li className="has-dropdown">
    //                     <span>Hi, {user.userName}</span>
    //                     <ul className="submenu">
    //                         <li><Link href="/my-account">My Account</Link></li>
    //                         <li onClick={() => logOut()}><Link href="">Logout</Link></li>
    //                     </ul>
    //                 </li>
    //             </ul>
    //         </div>
    //     );
    // }


    const searchKey = (e) => {
        e.preventDefault();
        localStorage.setItem('search_key', search);
        const searchkey = {
            search
        }
        dispatch(getSearchTutorAgency(searchkey));
    }
    const runSearch = (e) => {
        e.preventDefault();
        localStorage.setItem('search_key', search);
        const searchkey = {
            search
        }
        if (e.keyCode == 13) {
            dispatch(getSearchTutorAgency(searchkey));

        }

    }

    const genLinkUrl = () => {
        if(localCityName == "Select City"){
            return base_url_tutor + 'India';
        }else{
            return base_url_tutor + `${localCityName}`;
        }
    }

    const genLinkUrlIns = () => {
        if (localCityName == "Select City") {
            return base_url_ins + 'India';
        } else {
            return base_url_ins + `${localCityName}`;
        }
    }

    const genLinkUrlCounc = () => {
        if (localCityName == "Select City") {
            return base_url_counc + 'India';
        } else {
            return base_url_counc + `${localCityName}`;
        }
    }

    return (
        <div>

            <header>
                <div id="header-sticky" className="header__area header__transparent header__padding" style={{ background: '#fff' }}>
                    <div className="container-fluid">
                        <div className="row align-items-center">
                            <div className="col-xxl-3 col-xl-3 col-lg-4 col-md-2 col-sm-4 col-6">
                                <div className="header__left d-flex">
                                    <div className="logo project_logo">
                                        <Link href="/">
                                            <img src={base_url + "/assets/img/logo/logo.png"} alt="logo" />
                                        </Link>
                                    </div>
                                    <div className="header__category d-none d-lg-block">
                                        <nav>
                                            <ul>
                                                <li>
                                                    <a href="#" className="cat-menu d-flex align-items-center">
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
                                                        <li><Link href={genLinkUrl()}>Tutors</Link></li>
                                                        <li><Link href={genLinkUrlIns()}>Institutes</Link></li>
                                                        <li><Link href={genLinkUrlCounc()}>Councellors</Link></li>
                                                        <li><Link href="/blog">Library</Link></li>
                                                        <li><Link href="/contact">Contact Us</Link></li>
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
                                                        <i class="fa fa-map-marker" aria-hidden="true" style={{ marginRight: "5px" }}></i> {reduceCityData.reduceCity}
                                                    </Button>
                                                </li>

                                                <li className="has-dropdown">
                                                    <Link href="/">Find</Link>
                                                    <ul className="submenu">
                                                        <li><Link href={genLinkUrl()}>Tutors</Link></li>
                                                        <li><Link href={genLinkUrlIns()}>Institutes</Link></li>
                                                        <li><Link href={genLinkUrlCounc()}>Councellors</Link></li>
                                                    </ul>
                                                </li>
                                                <li className="">
                                                    <a href="#advertize_section">Advertise</a>
                                                </li>
                                                <li className="">
                                                    <Link href="/blog">Library</Link>
                                                </li>

                                                <li className="has-dropdown">
                                                    <Link href="/">Join</Link>
                                                    <ul className="submenu">
                                                        {
                                                            user.userId === '' ? renderSignIn() : renderLogout()
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
                                                    <img src={base_url + "assets/img/logo/notification.png"} alt="logo" />

                                                </div>
                                                <span className="cart-item">2</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div className="header__btn ml-20 d-none d-sm-block">
                                        {user.userName != '' || customer != '' ? renderLoginButMain(customertype) : renderLogOutBut()}

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
                                <img src={base_url+"assets/img/logo/logo.png"} alt="logo" />
                            </a>
                        </div>
                        <div className="">
                            <nav>
                                <ul>
                                    <li className="side__cls-btn" style={{ color: '#000', borderBottom: '1px solid #bbbcbf', padding: '10px', fontSize: '15px', fontWeight: '600' }}>
                                        <Link href="/">Home</Link>
                                    </li>

                                    <li className="side__cls-btn" style={{ color: '#000', borderBottom: '1px solid #bbbcbf', padding: '10px', fontSize: '15px', fontWeight: '600' }}><Link href={genLinkUrl()}>Tutors</Link></li>
                                    <li className="side__cls-btn" style={{ color: '#000', borderBottom: '1px solid #bbbcbf', padding: '10px', fontSize: '15px', fontWeight: '600' }}><Link href={genLinkUrlIns()}>Institutes</Link></li>

                                    <li className="side__cls-btn" style={{ color: '#000', borderBottom: '1px solid #bbbcbf', padding: '10px', fontSize: '15px', fontWeight: '600' }}>
                                        <a href="#advertize_section">Advertise</a>
                                    </li>
                                    <li className="side__cls-btn" style={{ color: '#000', borderBottom: '1px solid #bbbcbf', padding: '10px', fontSize: '15px', fontWeight: '600' }}>
                                        <Link href="/blog">Library</Link>
                                    </li>
                                    <li className="side__cls-btn" style={{ color: '#000', borderBottom: '1px solid #bbbcbf', padding: '10px', fontSize: '15px', fontWeight: '600' }}>
                                        <Link href="/contact">Contact</Link>
                                    </li>
                                    

                                    {
                                        user.userId === "" ? 
                                        <>
                                                <li className="side__cls-btn" style={{ color: '#000', borderBottom: '1px solid #bbbcbf', padding: '10px', fontSize: '15px', fontWeight: '600' }}>
                                                    <Link href="/signup-tutor">Tutor Signup</Link>
                                                </li>
                                                <li className="side__cls-btn" style={{ color: '#000', borderBottom: '1px solid #bbbcbf', padding: '10px', fontSize: '15px', fontWeight: '600' }}>
                                                    <Link href="/signup-institute">Institute Signup</Link>
                                                </li>

                                                <li className="side__cls-btn" style={{ color: '#000', borderBottom: '1px solid #bbbcbf', padding: '10px', fontSize: '15px', fontWeight: '600' }}>
                                                    <Link href="/signin">LogIn</Link>
                                                </li>
                                        </>
                                         : renderLogoutMobile()
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
                        {/* <div className="sidebar__cart mt-30">
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
                        </div> */}
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