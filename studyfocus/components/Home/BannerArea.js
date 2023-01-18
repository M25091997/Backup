import React, { useState, useEffect } from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { getInitialData, getInitialCityData } from '../../redux/actions';
import Link from 'next/link'


export default function BannerArea() {
    const dispatch = useDispatch();
    const [localCityId, setlocalCityId] = useState('0');


    useEffect(() => {
        setlocalCityId(localStorage.getItem('localCity'));
        const cityDataId = {
            localCityId
        }
        if (localStorage.getItem('localCity')!=undefined){

            (localStorage.getItem('localCity') == null || localStorage.getItem('localCity') == '') ? dispatch(getInitialData()) : dispatch(getInitialCityData(cityDataId));

        }

        // dispatch(getInitialData());
    }, [localCityId]);
    return (
        <section className="banner__area pb-110">
            <div className="container">
                <div className="row">
                    <div className="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                        <div className="banner__item p-relative mb-40" data-background="assets/img/banner/banner-bg-1.jpg">
                            <div className="banner__content">
                                <span>Free</span>
                                <h3 className="banner__title">
                                    <Link href="/signup-tutor">Join as Teacher</Link>
                                </h3>
                                <button className="e-btn e-btn-2">
                                    <Link href="/signup-tutor">Join</Link>
                                </button>
                                
                            </div>
                            {/* <div className="banner__thumb d-none d-sm-block d-md-none d-lg-block"> */}
                            <div className="banner__thumb d-sm-block d-md-none d-lg-block">

                                <img src="assets/img/banner/banner-img-1.png" alt="" />
                            </div>
                        </div>
                    </div>
                    <div className="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                        <div className="banner__item p-relative mb-40" data-background="assets/img/banner/banner-bg-2.jpg">
                            <div className="banner__content">
                                <span className="orange">Free</span>
                                <h3 className="banner__title">
                                    <Link href="/signup-tutor">Join as Institute</Link>
                                </h3>
                                <button className="e-btn e-btn-2">
                                    <Link href="/signup-institute">Join</Link>
                                </button>
                            </div>
                            <div className="banner__thumb banner__thumb-2 d-sm-block d-md-none d-lg-block">
                                {/* <div className="banner__thumb banner__thumb-2 d-none d-sm-block d-md-none d-lg-block"> */}

                                <img src="assets/img/banner/banner-img-2.png" alt="" />
                            </div>
                        </div>
                    </div>

                    <div className="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                        <div className="banner__item p-relative mb-40" data-background="assets/img/banner/banner-counc.jpg">
                            <div className="banner__content">
                                <span className="orange">Free</span>
                                <h3 className="banner__title">
                                    <Link href="/signup-tutor">Join as Councellor</Link>
                                </h3>
                                <button className="e-btn e-btn-2">
                                    <Link href="/signup-councellor">Join</Link>
                                </button>
                            </div>
                            <div className="banner__thumb banner__thumb-2 d-sm-block d-md-none d-lg-block">
                                {/* <div className="banner__thumb banner__thumb-2 d-none d-sm-block d-md-none d-lg-block"> */}

                                {/* <img src="assets/img/banner/11.png" alt="" /> */}
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </section>
    )
}
