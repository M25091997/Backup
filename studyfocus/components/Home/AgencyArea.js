import React, { useState, useEffect } from 'react';
import { useSelector } from 'react-redux';
import Link from 'next/link'
import { base_url_ins } from '../../helpers/urlConfig';
import Agency from './Agency'

export default function AgencyArea() {
    const [localCityName, setlocalCityName] = useState('Select City');
    const reduceCityData = useSelector(state => state.reduceCityData);

    const checkcity = () => {
        (localStorage.getItem('localCityName') == null || localStorage.getItem('localCityName') == '') ? localStorage.setItem('localCityName', "Select City") : setlocalCityName(localStorage.getItem('localCityName'));
    }
    const genLinkUrl = () => {
        if (localCityName == "Select City") {
            return base_url_ins + 'India';
        } else {
            return base_url_ins + `${localCityName}`;
        }
    }

    const genLinkUrlSub = (subname) => {
        if (reduceCityData.reduceCity == "Select City") {
            return base_url_ins + 'India/' + subname;
        } else {
            return base_url_ins + `${reduceCityData.reduceCity}` + '/' + subname;
        }
    }

    // const dispatch = useDispatch();
    useEffect(() => {
        checkcity();
    }, [localCityName]);
    return (
        <section className="course__area pb-120 grey-bg">
            <div className="container">
                <div className="row align-items-end">
                    <div className="col-xxl-5 col-xl-6 col-lg-6">
                        <div className="section__title-wrapper mb-60">
                            <h2 className="section__title">Find the Right<br /><span className="yellow-bg yellow-bg-big">Institute<img
                                src="assets/img/shape/yellow-bg.png" alt="" /></span> for you</h2>
                            <p>You don't have to struggle alone, you've got our assistance and help.</p>
                        </div>
                    </div>
                    <div className="col-xxl-7 col-xl-6 col-lg-6">
                        <div className="course__menu d-flex justify-content-lg-end mb-60">
                            <div className="masonary-menu filter-button-group">
                                <button className="active" data-filter="*">
                                    <Link href={genLinkUrl()}>See All</Link>
                            <span className="tag">new</span>
                                </button>
                                <button data-filter=".cat1"><Link href={genLinkUrlSub('English')}>English</Link></button>
                                <button data-filter=".cat2"><Link href={genLinkUrlSub('Maths')}>Maths</Link></button>
                                <button data-filter=".cat3"><Link href={genLinkUrlSub('Science')}>Science</Link></button>
                                <button data-filter=".cat4"><Link href={genLinkUrlSub('Physics')}>Physics</Link></button>
                            </div>
                        </div>
                    </div>
                </div>
                <Agency />
            </div>
        </section>
    )
}
