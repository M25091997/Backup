import React, { useState, useEffect } from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { getViewAllTutor, getViewAllTutorCity, getStateSubjectData, getfilterTutor } from '../../redux/actions';
import Tutor from './components/Tutor';
import Link from 'next/link';
import { useRouter } from 'next/router';
import Router from 'next/router';





export default function ViewTutors() {
    const router = useRouter()
    const { city, sub } = router.query;
    const dispatch = useDispatch();
    const initialSignupData = useSelector(state => state.initialSignupData);

    const [state, setState] = useState('0');
    const [getcity, setGetCity] = useState('0');
    const [scity, setSCity] = useState('0');
    const [subject, setSubject] = useState('0');
    const [cityId, setCityId] = useState('0');
    const [cityname, setCityName] = useState('');


    const filterSort = (e) => {
        let singlecityid = scity.split(',')['0'];
        let singlecityname = scity.split(',')['1'];

        setSCity(singlecityid);
        setCityName(singlecityname);
        // alert(cityname);
        // return;

        // if (subject == '' || state == '' || scity == '') {
        //     alert('Please Select all fields...');
        //     return false;
        // }
        const filter = {
            subject, state, scity
        }
        dispatch(getfilterTutor(filter));
        setState('0');
        setGetCity('0');
        setSCity('0');
        setSubject('0');
        if(cityname != '' || cityname != undefined){
            Router.push(singlecityname);
        }

        if (subject != '' || subject != undefined) {
            Router.push(sub);
        }
        



    }

    // we will use async/await to fetch this data
    async function getCity(state) {
        const res = await fetch("https://studyfocus.in/cybertechMedia/api/new-study-api/city/city_fetchAll.php?state=" + state);
        const city = await res.json();
        setGetCity(city);
    }

    const handleCity = (state) => {
        setState(state);
        getCity(state);
    }


    // const handleTutorsList = () => {
        
    //     console.log(cityId);
    //     const cityId = {
    //         cityId
    //     }
        
    // }

    useEffect(() => { 
        setCityId(localStorage.getItem('localCity'));
        // console.log(city);
        if (city != undefined) {
            const ciId = {
                city_name: `${city}`,
            }
            try {
                dispatch(getViewAllTutorCity(ciId));
                dispatch(getStateSubjectData());
            } catch (e) {
                console.log(e);
            }
        }
        // handleTutorsList();
        
    }, [city]);
    return (
        <>
            <section
                className="page__title-area page__title-height page__title-overlay d-flex align-items-center top_head_section"
            >
                <div className="container">
                    <div className="row">
                        <div className="col-xxl-12">
                            <div className="page__title-wrapper mt-110">
                                <h3 className="page__title">All Tutors from {city}</h3>
                                <nav aria-label="breadcrumb">
                                    <ol className="breadcrumb">
                                        <li className="breadcrumb-item"><Link href="/">Home</Link></li>
                                        <li className="breadcrumb-item active" aria-current="page">All Tutors from {city}</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section className="course__area pt-15 pb-120">
                <div className="container">
                    <br />
                    <div className="row">
                        <div className="col-md-12 col-xs-12">
                            <h1>Filters</h1>
                        </div>
                    </div>

                    <div className="row" style={{ margin: "1px" }}>
                        <div className="col-md-3 col-xs-12" style={{ border: "2px solid #fff" }}>
                            <select className="apna-form-control" style={{ height: "30px", lineHeight: "1", fontSize: "11px", fontWeight: "700", letterSpacing: "1px" }} value={state} onChange={(e) => { handleCity(e.target.value); }}>
                                <option value="0">Select State</option>
                                {
                                    initialSignupData.states && initialSignupData.states.length > 0 ? initialSignupData.states.map(state =>

                                        <option value={state.id}>{state.name}</option>

                                    ) : ""
                                }

                            </select>
                        </div>



                        <div className="col-md-3 col-xs-12" style={{ border: "2px solid #fff" }}>

                            <select className="apna-form-control" style={{ height: "30px", lineHeight: "1", fontSize: "11px", fontWeight: "700", letterSpacing: "1px" }} value={scity} onChange={(e) => { setSCity(e.target.value); }}>
                                <option value="0">Select State First</option>
                                {
                                    getcity.data && getcity.data.length > 0 ? getcity.data.map(cit =>

                                        <option value={cit.id + ',' +cit.name}>{cit.name}</option>

                                    ) : ""
                                }
                            </select>

                        </div>



                        <div className="col-md-3 col-xs-12" style={{ border: "2px solid #fff" }}>

                            <select className="apna-form-control" style={{ height: "30px", lineHeight: "1", fontSize: "11px", fontWeight: "700", letterSpacing: "1px" }} value={subject} onChange={(e) => { setSubject(e.target.value); }}>
                                <option value="0">Select Subjects</option>
                                {
                                    initialSignupData.subjects && initialSignupData.subjects.length > 0 ? initialSignupData.subjects.map(subject =>

                                        <option value={subject.id}>{subject.subject_name}</option>

                                    ) : ""
                                }
                            </select>
                        </div>



                        <div className="col-md-3 col-xs-12" style={{ border: "2px solid #fff" }}>

                            <button onClick={filterSort} className="e-btn w-100" style={{ height: "30px", lineHeight: "1" }} type="submit">Apply</button>

                        </div>




                    </div>

                    <br />


                    <Tutor />

                </div>
            </section>
        </>
    )
}