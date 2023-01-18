import React from 'react';
// import Image from 'next/image'
import { useSelector } from 'react-redux';
import { generatePublicUrl } from '../../helpers/urlConfig';

export default function Course() {
    // const searchTutorAgency = useSelector(state => state.searchTutorAgency);
    const initialData = useSelector(state => state.initialData);

    return (
        <div className="row grid">
            {
                initialData.tutors.length > 0 ?
                    initialData.tutors.map(tutor =>
                        <div className="col-xxl-3 col-xl-3 col-lg-3 col-md-4 grid-item cat1 cat2 cat4">
                            <div className="course__item white-bg mb-30 fix">
                                <div className="course__thumb w-img p-relative fix">
                                    <a href="course-details.html">
                                        <img width={216} height={129} src={generatePublicUrl('newtutor/' + tutor.profile)} alt="" />
                                    </a>
                                    <div className="course__tag">
                                        <a href="#">Art & Design</a>
                                    </div>
                                </div>
                                <div className="course__content" style={{ height: '187px' }}>
                                    <div className="course__meta d-flex align-items-center justify-content-between">
                                        <div className="course__lesson">
                                            <span><i className="far fa-book-alt"></i>43 Lesson</span>
                                        </div>
                                        <div className="course__rating">
                                            <span><i className="icon_star"></i>4.5 (44)</span>
                                        </div>
                                    </div>
                                    <h3 className="course__title"><a href="course-details.html">
                                        {(tutor.description.length < 28) ? tutor.description : tutor.description.slice(0, 28) + '...'}</a></h3>
                                    <div className="course__teacher d-flex align-items-center">
                                        <div className="course__teacher-thumb mr-15">
                                            <img src={generatePublicUrl('newtutor/' + tutor.profile)} alt="" />
                                        </div>
                                        <h6><a href="instructor-details.html">{tutor.name + ' ' + tutor.l_name}</a></h6>
                                    </div>
                                </div>
                                <div className="course__more d-flex justify-content-between align-items-center">
                                    <div className="course__status">
                                        <span>Free</span>
                                    </div>
                                    <div className="course__btn">
                                        <a href="course-details.html" className="link-btn">
                                            Know Details
                                            <i className="far fa-arrow-right"></i>
                                            <i className="far fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ) : null
            }

        </div>
    )
}