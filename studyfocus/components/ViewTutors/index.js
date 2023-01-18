import React, { useState, useEffect } from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { getViewAllTutor, removeSingleSub, getAdsData, getCityState, getSingleSub, getSingleState, getSingleCity, getViewAllTutorCity, getStateSubjectData, getfilterTutor, getRedCity } from '../../redux/actions';
import Tutor from './components/Tutor';
import Link from 'next/link';
import { useRouter } from 'next/router';
import Router from 'next/router';
import { base_url } from '../../helpers/urlConfig';
import Pagination from './Pagination';



export default function ViewTutors() {
    const router = useRouter();
    const { city, sub } = router.query;
    const dispatch = useDispatch();
    const initialSignupData = useSelector(state => state.initialSignupData);
    const stateId = useSelector(state => state.stateId);
    const tutorData = useSelector(state => state.viewAllTutor);
    const pageData = useSelector(state => state.pageno);


    const cId = useSelector(state => state.cId);
    const subId = useSelector(state => state.subId);
    const getcities = useSelector(state => state.getcities);

    const [state, setState] = useState('0');
    const [getcity, setGetCity] = useState('0');
    const [scity, setSCity] = useState('0');
    const [subject, setSubject] = useState('0');
    const [cityId, setCityId] = useState('0');
    const [cityname, setCityName] = useState('');
    // const [stateId, setStateId] = useState('0');


    const filterSort = (e) => {
        dispatch(removeSingleSub());
        setState(stateId.state_id);
        setSCity(stateId.city_id + ',' + stateId.city_name);
        setSubject(subId.subject_id + ',' + subId.subject_name);

        let singlecityid = scity.split(',')['0'];
        let singlecityname = scity.split(',')['1'];

        let subjectid = subject.split(',')['0'];
        let subjectname = subject.split(',')['1'];
        

        if (singlecityname == '' || singlecityname == undefined) {
            alert('Please select a city to proceed! ');
            return false;
        }
        

       
        const cityName = {
            singlecityname
        }
        dispatch(getRedCity(cityName));

        // alert(cityname);
        // return;

        // const filter = {
        //     subject, state, scity
        // }
        // dispatch(getfilterTutor(filter));
        // setState('0');
        // setGetCity('0');
        // setSCity('0');
        // setSubject('0');

        if (subjectname != undefined) {
            // alert('hi');
            Router.push(base_url + '/' + 'tutors/' + singlecityname + '/' + subjectname);
        } else if (singlecityname != undefined) {
            // alert('bi');
            Router.push(base_url + '/' + 'tutors/' + singlecityname);
        } else {
            Router.push(base_url);

        } 
        

        // if ((cityname != '' || cityname != undefined)) {
        //     Router.push(singlecityname);
        // } else if ((subjectname != '' || subjectname != undefined)){
        //     Router.push(singlecityname + '/' + subjectname);
        // }else{
        //     Router.push('/');

        // }

        // if (subject != '' || subject != undefined) {
        //     Router.push(sub);
        // }

    }

    // we will use async/await to fetch this data
    async function getCity(state) {
        // const res = await fetch("https://studyfocus.in/cybertechMedia/api/new-study-api/city/city_fetchAll.php?state=" + state);
        // const city = await res.json();
        // setGetCity(city);
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

    useEffect( async () => {
        setCityId(localStorage.getItem('localCity'));
        localStorage.setItem('localCityName', city);
        setState(stateId.state_id);
        setSCity(stateId.city_id + ',' + stateId.city_name);
        setSubject(subId.subject_id + ',' + subId.subject_name);

        if (sub == undefined) {
            dispatch(removeSingleSub());
        }

        // alert(cId.city_id);


        if (city != undefined) {
            const ciId = {
                city_name: `${city}`,
                sub_name: `${sub}`,
                page_no: 1
            }
            const siId = {
                sub_name: `${sub}`,
            }
            const stId = {
                sta_id: `${stateId.state_id}`,
            }

            
            try {
                dispatch(getSingleState(ciId));
                dispatch(getSingleCity(ciId));
                dispatch(getCityState(stId));
                dispatch(getSingleSub(siId));
                dispatch(getViewAllTutorCity(ciId));
                dispatch(getStateSubjectData());
                // dispatch(getAdsData());

            } catch (e) {
                console.log(e);
            }
        }

    }, [city, stateId.state_id, cId.city_id, stateId.city_id, subId.subject_id]);

    const getPage = (page) => {
        // console.log(page);
        // return;
        // if (city != undefined) {
        const cId = {
            city_name: `${city}`,
            sub_name: `${sub}`,
            page_no: page
        }
    // }
    // console.log(cId);
    // return;

        try {
            dispatch(getViewAllTutorCity(cId));
        } catch (e) {
            console.log(e);
        }

    }

    // const Pagination = () => {
    //     // if (tutorData.tutors_count != null || tutorData.tutors_count != undefined) {
    //     //     let count_tutor = 3000;
    //     //     let i = [];
    //     //     Array.from(Array(parseInt(tutorData.tutors_count / 25)), (e, x) => {
    //     //         i.push(x);
    //     //     })
    //     //     // let i = [1,2,3,4,5,6,7,8,9,10,11,12];
    //     //     {console.log(i.length)}
            
    //     //         return(
    //     //     <ul className="d-flex align-items-center">
    //     //             {
    //     //                     ((tutorData.tutors_count/25) > 9) ? i.map(x => <div>{x}</div>): "data"
    //     //             }
    //     //         </ul>)
            
    //     // } else {
    //     //     return <> </>
    //     // }
    //     console.log('pagination called')
    //     return (<> </>)

    // }

    // const Pagination = () => {
    //     if (tutorData.tutors_count != null || tutorData.tutors_count != undefined){
    //         return <ul className="d-flex align-items-center">{Array.from(Array(parseInt(tutorData.tutors_count / 25)), (e, i) => {
    //             console.log(i);
    //             if(i>9){
                     
    //             }else{
    //                 return <li onClick={() => getPage(i + 1)} key={i} className="">
    //                     <a>
    //                         <span>{i + 1}</span>
    //                     </a>
    //                 </li>
    //             }

    //             if(!i>9){
    //                 <li onClick={() => getPage(i + 1)} key={i} className="">
    //                     <a>
    //                         <span>Next <i className="fa fa-angle-double-right" aria-hidden="true"></i></span>
    //                     </a>
    //                 </li>
    //             }
                
    //         })}</ul>
    //     }else{
    //         return <> </>
    //     }
        
    // }
    return (
        <>
            <section
                className="page__title-area page__title-height page__title-overlay d-flex align-items-center top_head_section"
            >
                <div className="container">
                    <div className="row">
                        <div className="col-xxl-12">
                            <div className="page__title-wrapper mt-110">
                                {sub != undefined ? 
                                    <h3 className="page__title">{sub + ' Tutors'} from {city}</h3> :
                                    <h3 className="page__title">All Tutors from {city}</h3>
                                }

                                <nav aria-label="breadcrumb">
                                    <ol className="breadcrumb">
                                        <li className="breadcrumb-item"><Link href="/">Home</Link></li>
                                        <li className="breadcrumb-item active" aria-current="page">All Tutors from {city}</li>
                                        <li className="breadcrumb-item active" aria-current="page">Page No {pageData.pageNo}</li>

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

                                        <option value={cit.id + ',' + cit.name}>{cit.name}</option>

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
                    <div className="row">
                        <div className="col-xxl-12">
                            <div className="basic-pagination wow fadeInUp mt-30" data-wow-delay=".2s">
                                {
                                    tutorData.tutors && tutorData.tutors.length ? 
                                    <Pagination x={tutorData.tutors_count} />
                                    // <>hi {console.log('test called')}</>
                                    : ""

                                }

                            </div>
                        </div>
                    </div>

                </div>
            </section>
        </>
    )
}