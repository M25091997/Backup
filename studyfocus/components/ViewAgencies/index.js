import React, { useState, useEffect } from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { getViewAllAgency, removeSingleSub, getCityState, getSingleSub, getSingleState, getRedCity, getViewAllAgencyCity, getStateSubjectData, getfilterAgency } from '../../redux/actions';
import Tutor from './components/Tutor';
import Link from 'next/link';
import { useRouter } from 'next/router';
import Router from 'next/router';
import { base_url } from '../../helpers/urlConfig';






export default function ViewTutors() {
    const router = useRouter();

    const dispatch = useDispatch();
    const { area, subjects } = router.query;

    const initialSignupData = useSelector(state => state.initialSignupData);
    const stateId = useSelector(state => state.stateId);
    const getcities = useSelector(state => state.getcities);
    const subId = useSelector(state => state.subId);


    const [state, setState] = useState('0');
    const [city, setCity] = useState('0');
    const [scity, setSCity] = useState('0');
    const [subject, setSubject] = useState('0');
    const [cityId, setCityId] = useState('0');
    const [cityname, setCityName] = useState('');

    const filterSort = (e) => {
        dispatch(removeSingleSub());

        setState(stateId.state_id);
        setSCity(stateId.city_id + ',' + stateId.city_name);
        setSubject(subId.subject_id + ',' + subId.subject_name);

        let singlecityid = scity.split(',')['0'];
        let singlecityname = scity.split(',')['1'];
        let subjectid = subject.split(',')['0'];
        let subjectname = subject.split(',')['1'];
        // alert(subjectname);
        // return;

        if (singlecityname == '' || singlecityname == undefined) {
            alert('Please select a city to proceed! ');
            return false;
        }

        // setSCity(singlecityid);
        // setCityName(singlecityname);
        const cityName = {
            singlecityname
        }
        dispatch(getRedCity(cityName));

        // setState('0');
        // setSCity('0');
        // setSubject('0');
        

        if (subjectname != undefined) {
            // alert('hi');
            Router.push(base_url + '/' + 'institutes/' + singlecityname + '/' + subjectname);
        } else if (singlecityname != undefined) {
            // alert('bi');
            Router.push(base_url + '/' + 'institutes/' + singlecityname);
        } else {
            Router.push(base_url);

        }
        

    }


    // we will use async/await to fetch this data
    async function getCity(state) {
        // const res = await fetch("https://studyfocus.in/cybertechMedia/api/new-study-api/city/city_fetchAll.php?state=" + state);
        // const city = await res.json();
        // console.log(city);
        // return false;
        // store the city into our city variable
        // setCity(city);
        const stId = {
            sta_id: `${state}`,
        }
        console.log(stId);
        // return;
        dispatch(getCityState(stId));
    }

    const handleCity = (state) => {
        setState(state);
        getCity(state);
    }

    useEffect(() => {
        setCityId(localStorage.getItem('localCity'));
        localStorage.setItem('localCityName', area);
        setState(stateId.state_id);
        setSCity(stateId.city_id + ',' + stateId.city_name);
        setSubject(subId.subject_id + ',' + subId.subject_name);

        if (subjects == undefined) {
            dispatch(removeSingleSub());
        }
        
        if (area != undefined) {
            const ciId = {
                city_name: `${area}`,
                sub_name: `${subjects}`,
            }
            const siId = {
                sub_name: `${subjects}`,
            }
            const stId = {
                sta_id: `${stateId.state_id}`,
            }
            try {
                dispatch(getSingleState(ciId));
                dispatch(getCityState(stId));
                dispatch(getSingleSub(siId));
                dispatch(getViewAllAgencyCity(ciId));
                dispatch(getStateSubjectData());
            } catch (e) {
                console.log(e);
            }
        }
        // handleTutorsList();

    }, [area, stateId.state_id, stateId.city_id, subId.subject_id]);


    // useEffect(() => {
    //     dispatch(getViewAllAgency());
    //     dispatch(getStateSubjectData());
    // }, []);
    return (
        <>
            <section
                className="page__title-area page__title-height page__title-overlay d-flex align-items-center top_head_section"
            // style={{ backgroundImage: 'url(assets/img/page-title/page-title.jpg)' }}
            // style={{ minHeight: '150px' }}

            >
                <div className="container">
                    <div className="row">
                        <div className="col-xxl-12">
                            <div className="page__title-wrapper mt-110">
                                <h3 className="page__title">All Institutes from {area}</h3>
                                <nav aria-label="breadcrumb">
                                    <ol className="breadcrumb">
                                        <li className="breadcrumb-item"><Link href="/">Home</Link></li>
                                        <li className="breadcrumb-item active" aria-current="page">All Institutes from {area}</li>
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
                                    getcities.getcities && getcities.getcities.length > 0 ? getcities.getcities.map(cit =>

                                        <option value={cit.id + ',' + cit.name  }>{cit.name}</option>

                                    ) : ""
                                }
                            </select>

                        </div>



                        <div className="col-md-3 col-xs-12" style={{ border: "2px solid #fff" }}>

                            <select className="apna-form-control" style={{ height: "30px", lineHeight: "1", fontSize: "11px", fontWeight: "700", letterSpacing: "1px" }} value={subject} onChange={(e) => { setSubject(e.target.value); }}>
                                <option value="0">Select Subjects</option>
                                {
                                    initialSignupData.subjects && initialSignupData.subjects.length > 0 ? initialSignupData.subjects.map(subject =>

                                        <option value={subject.id + ',' + subject.subject_name}>{subject.subject_name}</option>

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