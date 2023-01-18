import React, { useEffect, useState } from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { useRouter } from 'next/router';
import { getSingleAgency } from '../../../redux/actions';
import { RelatedSection } from './RelatedSection'
import { TabsSection } from './TabsSection'
import { generatePublicUrl } from '../../../helpers/urlConfig';
import moment from 'moment';


export const MainDetail1 = () => {
    const router = useRouter()
    const { agencysearch } = router.query;
    const dispatch = useDispatch();
    const singleAgency = useSelector(state => state.singleAgencyData);


    useEffect(() => {
        if (agencysearch != undefined) {
            const bslug = {
                agency_slug: `${agencysearch}`,
            }
            console.log(bslug);
            // return false;
            try {
                dispatch(getSingleAgency(bslug));
            } catch (e) {
                console.log(e);
            }
        }
    }, [agencysearch]);
    return (
        <>
            <div className="course__wrapper">
                {
                    singleAgency.singleagency.agency && singleAgency.singleagency.agency.length > 0 ? singleAgency.singleagency.agency.map(agency =>
                        <>
                            <div className="page__title-content mb-25">
                                <div className="page__title-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol className="breadcrumb">
                                            <li className="breadcrumb-item"><a href="index-2.html">Home</a></li>
                                            <li className="breadcrumb-item"><a href="course-grid.html">Courses</a></li>
                                            <li className="breadcrumb-item active" aria-current="page">The business Intelligence analyst Course 2022</li>
                                        </ol>
                                    </nav>
                                </div>
                                <span className="page__title-pre">Tutor</span>
                                <h5 className="page__title-3">{agency.description}</h5>
                            </div>
                            <div className="course__meta-2 d-sm-flex mb-30">
                                <div className="course__teacher-3 d-flex align-items-center mr-70 mb-30">
                                    <div className="course__teacher-thumb-3 mr-15">
                                        <img src={generatePublicUrl('newtutor/' + agency.img)} alt="" />
                                    </div>
                                    <div className="course__teacher-info-3">
                                        <h5>Teacher</h5>
                                        <p><a href="#">{agency.name}</a></p>
                                    </div>
                                </div>
                                <div className="course__update mr-80 mb-30">
                                    <h5>Joining Date:</h5>
                                    <p>
                                        {

                                            moment(Date.parse(agency.trn_date)).format('ll')

                                        }
                                    </p>
                                </div>
                                <div className="course__rating-2 mb-30">
                                    <h5>Review:</h5>
                                    <div className="course__rating-inner d-flex align-items-center">
                                        <ul>
                                            <li><a href="#"> <i className="icon_star"></i> </a></li>
                                            <li><a href="#"> <i className="icon_star"></i> </a></li>
                                            <li><a href="#"> <i className="icon_star"></i> </a></li>
                                            <li><a href="#"> <i className="icon_star"></i> </a></li>
                                            <li><a href="#"> <i className="icon_star"></i> </a></li>
                                        </ul>
                                        <p>4.5</p>
                                    </div>
                                </div>
                            </div>
                            <div className="course__img w-img mb-30">
                                <img src={generatePublicUrl('subjects/' + agency.img)} alt="" />
                            </div>
                        </>
                    ) : ""
                }
                <TabsSection />
                <RelatedSection />
            </div>

        </>
    )
}
