import React, { useState, useEffect } from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { getInitialData, getInitialSignup, getSearchTutorAgency } from '../../redux/actions';
import Tutor from './components/Tutor';
import Agency from './components/Agency'
import Link from 'next/link';




export default function Search() {
    const dispatch = useDispatch();
    const initialSignupData = useSelector(state => state.initialSignupData);

    const [state, setState] = useState('');
    const [city, setCity] = useState('');
    const [subject, setSubject] = useState('');
    const [tutor, setTutor] = useState('1');
    const [agency, setAgency] = useState('');
    const [councellor, setCouncellor] = useState('');

    const showTutor = () => {
        setCouncellor('');
        setAgency('');
        setTutor('1');
    }
    const showAgency = () => {
        setTutor('');
        setCouncellor('');
        setAgency('1');
    }
    const showCouncellor = () => {
        setTutor('');
        setCouncellor('');
        setAgency('');
    }



    // we will use async/await to fetch this data
    async function getCity(state) {
        const res = await fetch("http://localhost/cybertechMedia/api/new-study-api/city/city_fetchAll.php?state=" + state);
        const city = await res.json();
        // console.log(city);
        // return false;
        // store the city into our city variable
        setCity(city);
    }

    const handleCity = (state) => {
        setState(state);
        getCity(state);
    }


    useEffect(() => {
        // dispatch(getInitialData());
        
        let search = localStorage.getItem('search_key');
        const searchkey = {
            search
        }
        dispatch(getSearchTutorAgency(searchkey));
        dispatch(getInitialSignup());
    }, []);
    return (
        <>
            <section className="page__title-area page__title-height page__title-overlay d-flex align-items-center top_head_section" >
                <div className="container">
                    <div className="row">
                        <div className="col-xxl-12">
                            <div className="page__title-wrapper mt-110">
                                <h3 className="page__title">Search From India</h3>
                                <nav aria-label="breadcrumb">
                                    <ol className="breadcrumb">
                                        <li className="breadcrumb-item"><a href="index-2.html">Home</a></li>
                                        <li className="breadcrumb-item active" aria-current="page">Search</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section className="course__area pt-15 pb-120">
                <div className="container">
                    <div className="course__tab-inner grey-bg-2 mb-50">
                        <div className="row align-items-center">
                            <div className="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div className="row">
                                    <div className="course__tab-2 mb-45">
                                        <ul className="nav nav-tabs" id="courseTab" role="tablist">
                                            <li className="nav-item" role="presentation">
                                                <button className="nav-link active" onClick={showTutor} id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true"> <i className="fal fa-user"></i> <span>Tutor</span> </button>
                                            </li>
                                            <li className="nav-item" role="presentation">
                                                <button className="nav-link " onClick={showAgency} id="curriculum-tab" data-bs-toggle="tab" data-bs-target="#curriculum" type="button" role="tab" aria-controls="curriculum" aria-selected="false"> <i className="fal fa-user"></i> <span>Agency</span> </button>
                                            </li>
                                            <li className="nav-item" role="presentation">
                                                <button className="nav-link" onClick={showCouncellor} id="review-tab" data-bs-toggle="tab" data-bs-target="#review" type="button" role="tab" aria-controls="review" aria-selected="false"> <i className="fal fa-user"></i> <span>Councellor</span> </button>
                                            </li>
                                            <li className="nav-item" role="presentation">
                                                <button className="nav-link" id="member-tab" data-bs-toggle="tab" data-bs-target="#member" type="button" role="tab" aria-controls="member" aria-selected="false"> <i className="fal fa-user"></i> <span><Link href="../blog">Blogs</Link></span> </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                {/* <div className='row'>
                                    <div className='col-md-4'>
                                        <button className="e-btn w-100" onClick={showTutor}>Tutor</button>
                                    </div>
                                    <div className='col-md-4'>
                                        <button className="e-btn w-100" onClick={showAgency}>Agency</button>
                                    </div>
                                    <div className='col-md-4'>
                                        <button className="e-btn w-100" onClick={showCouncellor}>Councellor</button>
                                    </div>
                                </div> */}
                            </div>

                        </div>
                    </div>
                    {tutor == '1' ? <Tutor /> : ''}
                    {agency == '1' ? <Agency /> : ''}



                </div>
            </section>
        </>
    )
}