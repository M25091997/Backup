import React, { useEffect, useState } from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { useRouter } from 'next/router';
import { getSingleTutor } from '../../../redux/actions';
import { RelatedSection } from './RelatedSection'
import { TabsSection } from './TabsSection'
import { generatePublicUrl } from '../../../helpers/urlConfig';
import moment from 'moment';



export const MainDetail = () => {
    const router = useRouter()
    const { search } = router.query;
    const dispatch = useDispatch();
    const singleTutor = useSelector(state => state.singleTutorData);


    useEffect(() => {
        if (search != undefined) {
            const bslug = {
                tutor_slug: `${search}`,
            }
            console.log(bslug);
            // return false;
            try {
                dispatch(getSingleTutor(bslug));
            } catch (e) {
                console.log(e);
            }
        }
    }, [search]);
    return (
        <>
            <div className="course__wrapper">
                {
                    singleTutor.singletutor.tutors && singleTutor.singletutor.tutors.length > 0 ? singleTutor.singletutor.tutors.map(tutor =>
                        <>
                            <div className="page__title-content mb-25">
                                <div className="page__title-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol className="breadcrumb">
                                            <li className="breadcrumb-item"><a href="index-2.html">Home</a></li>
                                            <li className="breadcrumb-item"><a href="course-grid.html">Tutors</a></li>
                                            <li className="breadcrumb-item active" aria-current="page">
                                                {tutor.name + " " + tutor.l_name}
                                            </li>
                                        </ol>
                                    </nav>
                                </div>
                                <span className="page__title-pre">Development</span>
                                <h5 className="page__title-3">
                                    {tutor.name + " " + tutor.l_name}
                                </h5>
                            </div>
                            <div className="course__meta-2 d-sm-flex mb-30">
                                <div className="course__teacher-3 d-flex align-items-center mr-70 mb-30">
                                    <div className="course__teacher-thumb-3 mr-15">
                                        <img src={generatePublicUrl('newtutor/' + tutor.profile)} alt="" />
                                    </div>
                                    <div className="course__teacher-info-3">
                                        <h5>Teacher</h5>
                                        <p><a href="#">
                                            {tutor.name + " " + tutor.l_name}
                                        </a></p>
                                    </div>
                                </div>
                                <div className="course__update mr-80 mb-30">
                                    <h5>Joining Date:</h5>
                                    <p>
                                        {

                                            moment(Date.parse(tutor.trn_date)).format('ll')

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
                                <img src={generatePublicUrl('subjects/' + tutor.img)} alt="" />
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
