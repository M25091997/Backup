import React, { useEffect } from 'react';
import { getInitialData } from '../../redux/actions';
import { useDispatch } from 'react-redux';
import Agency from '../Common/Agency'


export default function CourseSection() {
    const dispatch = useDispatch();
    useEffect(() => {
        // dispatch(getInitialData());
    }, []);
    return (
        <>
            <section className="page__title-area page__title-height page__title-overlay d-flex align-items-center" style={{ backgroundImage: 'url(assets/img/page-title/page-title.jpg)' }}>
                <div className="container">
                    <div className="row">
                        <div className="col-xxl-12">
                            <div className="page__title-wrapper mt-110">
                                <h3 className="page__title">Contact</h3>
                                <nav aria-label="breadcrumb">
                                    <ol className="breadcrumb">
                                        <li className="breadcrumb-item"><a href="index-2.html">Home</a></li>
                                        <li className="breadcrumb-item active" aria-current="page">Courses</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section className="course__area pt-120 pb-120">
                <div className="container">
                    <div className="course__tab-inner grey-bg-2 mb-50">
                        <div className="row align-items-center">
                            <div className="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div className="course__tab-wrapper d-flex align-items-center">
                                    <div className="course__tab-btn">
                                        <ul className="nav nav-tabs" id="courseTab" role="tablist">
                                            <li className="nav-item" role="presentation">
                                                <button className="nav-link active" id="grid-tab" data-bs-toggle="tab"
                                                    data-bs-target="#grid" type="button" role="tab" aria-controls="grid"
                                                    aria-selected="true">
                                                    <svg className="grid" viewBox="0 0 24 24">
                                                        <rect x="3" y="3" className="st0" width="7" height="7" />
                                                        <rect x="14" y="3" className="st0" width="7" height="7" />
                                                        <rect x="14" y="14" className="st0" width="7" height="7" />
                                                        <rect x="3" y="14" className="st0" width="7" height="7" />
                                                    </svg>
                                                </button>
                                            </li>
                                            <li className="nav-item" role="presentation">
                                                <button className="nav-link list" id="list-tab" data-bs-toggle="tab"
                                                    data-bs-target="#list" type="button" role="tab" aria-controls="list"
                                                    aria-selected="false">
                                                    <svg className="list" viewBox="0 0 512 512">
                                                        <g id="Layer_2_1_">
                                                            <path className="st0"
                                                                d="M448,69H192c-17.7,0-32,13.9-32,31s14.3,31,32,31h256c17.7,0,32-13.9,32-31S465.7,69,448,69z" />
                                                            <circle className="st0" cx="64" cy="100" r="31" />
                                                            <path className="st0"
                                                                d="M448,225H192c-17.7,0-32,13.9-32,31s14.3,31,32,31h256c17.7,0,32-13.9,32-31S465.7,225,448,225z" />
                                                            <circle className="st0" cx="64" cy="256" r="31" />
                                                            <path className="st0"
                                                                d="M448,381H192c-17.7,0-32,13.9-32,31s14.3,31,32,31h256c17.7,0,32-13.9,32-31S465.7,381,448,381z" />
                                                            <circle className="st0" cx="64" cy="412" r="31" />
                                                        </g>
                                                    </svg>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                    <div className="course__view">
                                        <h4>Showing 1 - 9 of 84</h4>
                                    </div>
                                </div>
                            </div>
                            <div className="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div className="course__sort d-flex justify-content-sm-end">
                                    <div className="course__sort-inner">
                                        <select>
                                            <option>Default</option>
                                            <option>Option 1</option>
                                            <option>Option 2</option>
                                            <option>Option 3</option>
                                            <option>Option 4</option>
                                            <option>Option 5</option>
                                            <option>Option 6</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <Agency />
                    <div className="row">
                        <div className="col-xxl-12">
                            <div className="basic-pagination wow fadeInUp mt-30" data-wow-delay=".2s">
                                <ul className="d-flex align-items-center">
                                    <li className="prev">
                                        <a href="course-grid.html" className="link-btn link-prev">
                                            Prev
                                <i className="arrow_left"></i>
                                            <i className="arrow_left"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="course-grid.html">
                                            <span>1</span>
                                        </a>
                                    </li>
                                    <li className="active">
                                        <a href="course-grid.html">
                                            <span>2</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="course-grid.html">
                                            <span>3</span>
                                        </a>
                                    </li>
                                    <li className="next">
                                        <a href="course-grid.html" className="link-btn">
                                            Next
                                <i className="arrow_right"></i>
                                            <i className="arrow_right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </>
    )
}