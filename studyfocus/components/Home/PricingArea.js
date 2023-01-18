import React from 'react'

export default function PricingArea() {
    return (
        <section className="price__area pt-60 pb-130" id="advertize_section">
            <div className="container">
                <div className="row">
                    <div className="col-xxl-4 offset-xxl-4">
                        <div className="section__title-wrapper mb-60 text-center">
                            <h2 className="section__title">Advertise<br />  <span
                                className="yellow-bg yellow-bg-big">With Us<img src="assets/img/shape/yellow-bg.png"
                                    alt="" /></span></h2>
                            <p>Be Featured Tutor or Run Tutor Ads.</p>
                        </div>
                    </div>
                </div>
                <div className="row">
                    <div className="col-xxl-12">
                        <div className="price__tab-btn text-center mb-50">
                            <nav>
                                <div className="nav nav-tabs justify-content-center" id="nav-tab" role="tablist">
                                    <button className="nav-link" id="nav-monthly-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-monthly" type="button" role="tab" aria-controls="nav-monthly"
                                        aria-selected="true">Half Yearly Plan</button>
                                    <button className="nav-link active" id="nav-annually-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-annually" type="button" role="tab" aria-controls="nav-annually"
                                        aria-selected="false">Annual Plan</button>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
                <div className="row">
                    <div className="col-xxl-10 offset-xxl-1 col-xl-10 offset-xl-1 col-lg-10 offset-lg-1">
                        <div className="price__tab-content">
                            <div className="tab-content" id="nav-tabContent">
                                <div className="tab-pane fade" id="nav-monthly" role="tabpanel" aria-labelledby="nav-monthly-tab">
                                    <div className="row">
                                        <div className="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                                            <div className="price__item grey-bg mb-30 p-relative">
                                                <div className="price__head">
                                                    <h3>Featured Tutor</h3>
                                                    <p>Perfect for quick tution offers.</p>
                                                    {/* <h3>Gold</h3>
                                                    <p>Perfect for small marketing teams</p> */}
                                                </div>
                                                <div className="price__tag mb-25">
                                                    <h4>Rs.399<span>.00 / for 6 months</span></h4>
                                                    {/* <h4>Rs.0<span>.00 / annually</span></h4> */}
                                                </div>
                                                <div className="price__features mb-40">
                                                    <ul>
                                                        <li><i className="far fa-check"></i>Profile Shown on Home Page</li>
                                                        <li><i className="far fa-check"></i>First Preferrence offers through SMS</li>
                                                        <li><i className="far fa-check"></i>For home and online tutors</li>
                                                        {/* <li><i className="far fa-check"></i>Course Discussions</li>
                                                        <li><i className="far fa-check"></i>Content Library</li>
                                                        <li><i className="far fa-check"></i>1-hour Mentorship</li> */}
                                                    </ul>
                                                </div>
                                                <a href="/contact" className="e-btn e-btn-4">Get Started</a>
                                            </div>
                                        </div>
                                        <div className="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                                            <div className="price__item grey-bg mb-30 p-relative">
                                                <div className="price__offer">
                                                    <span>Best Value</span>
                                                </div>
                                                <div className="price__head">
                                                    <h3>Tutor Ads</h3>
                                                    <p>Perfect for all India Reach</p>
                                                    {/* <h3>Diamond</h3>
                                                    <p>Perfect for small marketing teams</p> */}
                                                </div>
                                                <div className="price__tag mb-25">
                                                    <h4>Rs.899<span>.00 / for 6 months</span></h4>
                                                    {/* <h4>Rs.0<span>.00 / annually</span></h4> */}
                                                </div>
                                                <div className="price__features mb-40">
                                                    <ul>
                                                        <li><i className="far fa-check"></i>Ads shown in search and all other pages.</li>
                                                        <li><i className="far fa-check"></i>Click through Ad - Get traffic to your own website.</li>
                                                        <li><i className="far fa-check"></i>For Tutors, Institutes and Agencies</li>
                                                        {/* <li><i className="far fa-check"></i>Online Course</li> */}
                                                        {/* <li><i className="far fa-check"></i>Course Discussions</li>
                                                        <li><i className="far fa-check"></i>Content Library</li>
                                                        <li><i className="far fa-check"></i>1-hour Mentorship</li>
                                                        <li><i className="far fa-check"></i>Online Course</li> */}
                                                    </ul>
                                                </div>
                                                {/* <a href="/contact" className="e-btn e-btn-border">Get Started</a> */}
                                                <a href="/contact" className="e-btn e-btn-4">Get Started</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div className="tab-pane fade show active" id="nav-annually" role="tabpanel"
                                    aria-labelledby="nav-annually-tab">
                                    <div className="row">
                                        <div className="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                                            <div className="price__item grey-bg mb-30 p-relative">
                                                <div className="price__head">
                                                    <h3>Featured Tutor</h3>
                                                    <p>Perfect for quick tution offers.</p>
                                                    {/* <h3>Gold</h3>
                                                    <p>Perfect for small marketing teams</p> */}
                                                </div>
                                                <div className="price__tag mb-25">
                                                    <h4>Rs.649<span>.00 / annually</span></h4>
                                                    {/* <h4>Rs.0<span>.00 / annually</span></h4> */}
                                                </div>
                                                <div className="price__features mb-40">
                                                    <ul>
                                                        <li><i className="far fa-check"></i>Profile Shown on Home Page</li>
                                                        <li><i className="far fa-check"></i>First Preferrence offers through SMS</li>
                                                        <li><i className="far fa-check"></i>For home and online tutors</li>
                                                        {/* <li><i className="far fa-check"></i>Course Discussions</li>
                                                        <li><i className="far fa-check"></i>Content Library</li>
                                                        <li><i className="far fa-check"></i>1-hour Mentorship</li> */}
                                                    </ul>
                                                </div>
                                                <a href="/contact" className="e-btn e-btn-4">Get Started</a>
                                            </div>
                                        </div>
                                        <div className="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                                            <div className="price__item grey-bg mb-30 p-relative">
                                                <div className="price__offer">
                                                    <span>Best Value</span>
                                                </div>
                                                <div className="price__head">
                                                    <h3>Tutor Ads</h3>
                                                    <p>Perfect for all India Reach</p>
                                                    {/* <h3>Diamond</h3>
                                                    <p>Perfect for small marketing teams</p> */}
                                                </div>
                                                <div className="price__tag mb-25">
                                                    <h4>Rs.1499<span>.00 / annually</span></h4>
                                                </div>
                                                <div className="price__features mb-40">
                                                    <ul>
                                                        <li><i className="far fa-check"></i>Ads shown in search and all other pages.</li>
                                                        <li><i className="far fa-check"></i>Click through Ad - Get traffic to your own website.</li>
                                                        <li><i className="far fa-check"></i>For Tutors, Institutes and Agencies</li>
                                                        {/* <li><i className="far fa-check"></i>Course Discussions</li>
                                                        <li><i className="far fa-check"></i>Content Library</li>
                                                        <li><i className="far fa-check"></i>1-hour Mentorship</li>
                                                        <li><i className="far fa-check"></i>Online Course</li> */}
                                                    </ul>
                                                </div>
                                                {/* <a href="/contact" className="e-btn e-btn-border">Get Started</a> */}
                                                <a href="/contact" className="e-btn e-btn-4">Get Started</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    )
}
