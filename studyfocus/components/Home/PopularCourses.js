import React, { useState, useEffect } from 'react';
import { useSelector } from 'react-redux';
// import { base_url_tutor } from '../../helpers/urlConfig';
// import Link from 'next/link'
import { SubjectCard } from '../SubjectCard';



export default function PopularCourses() {
    const initialData = useSelector(state => state.initialData);
    const reduceCityData = useSelector(state => state.reduceCityData);

    // const [localCityName, setlocalCityName] = useState('Select City');
    // const checkcity = () => {
    //     (localStorage.getItem('localCityName') == null || localStorage.getItem('localCityName') == '') ? localStorage.setItem('localCityName', "Select City") : setlocalCityName(localStorage.getItem('localCityName'));
    // }
    // const genLinkUrlSub = (subname) => {
    //     if (reduceCityData.reduceCity == "Select City") {
    //         return base_url_tutor + 'India/' + subname;
    //     } else {
    //         return base_url_tutor + `${reduceCityData.reduceCity}` + '/'+ subname;
    //     }
    // }

    // useEffect(() => {
    //     checkcity();
    // }, [localCityName]);

    // const product = useSelector(state => state.product);
    return (

        <section className="category__area pt-120 pb-70">
            <div className="container">
                <div className="row align-items-end">
                    <div className="col-xxl-6 col-xl-6 col-lg-6 col-md-8">
                        <div className="section__title-wrapper mb-45">
                            <h2 className="section__title">Explore <br />Teachers <span className="yellow-bg">By <img
                                src="assets/img/shape/yellow-bg-2.png" alt="" /> </span>Subjects
                    </h2>
                        </div>
                    </div>
                    {/* <div className="col-xxl-6 col-xl-6 col-lg-6 col-md-4">
                        <div className="category__more mb-50 float-md-end fix">
                            <a href="course-grid.html" className="link-btn">
                                View all Category
                        <i className="far fa-arrow-right"></i>
                                <i className="far fa-arrow-right"></i>
                            </a>
                        </div>
                    </div> */}
                </div>

                <div className="row">
                    {
                        initialData.subjects.length > 0 ?
                            initialData.subjects.map(subject =>
                                    <SubjectCard x={subject} />

                            ) : null
                    }

                </div>
            </div>
        </section>
    )
}
