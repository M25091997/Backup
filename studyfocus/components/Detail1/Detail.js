import React from 'react'
import { MainDetail } from './components/MainDetail'
import { Sidebar } from './components/Sidebar'

const Detail = () => {
    return (
        <>
            <section className="page__title-area pt-120 pb-90">
                <div className="page__title-shape">
                    <img className="page-title-shape-5 d-none d-sm-block" src="assets/img/page-title/page-title-shape-1.png" alt="" />
                    <img className="page-title-shape-6" src="assets/img/page-title/page-title-shape-6.png" alt="" />
                    <img className="page-title-shape-7" src="assets/img/page-title/page-title-shape-4.png" alt="" />
                </div>
                <div className="container">
                    <div className="row">
                        <div className="col-xxl-8 col-xl-8 col-lg-8">
                            <MainDetail />
                        </div>
                        <div className="col-xxl-4 col-xl-4 col-lg-4">
                            <Sidebar />
                        </div>
                    </div>
                </div>
            </section>

            <section className="cta__area mb--120">
                <div className="container">
                    <div className="cta__inner blue-bg fix">
                        <div className="cta__shape">
                            <img src="/assets/img/cta/cta-shape.png" alt="" />
                        </div>
                        <div className="row align-items-center">
                            <div className="col-xxl-7 col-xl-7 col-lg-8 col-md-8">
                                <div className="cta__content">
                                    <h3 className="cta__title">You can be your own Guiding star with our help</h3>
                                </div>
                            </div>
                            <div className="col-xxl-5 col-xl-5 col-lg-4 col-md-4">
                                <div className="cta__more d-md-flex justify-content-end p-relative z-index-1">
                                    <a href="contact.html" className="e-btn e-btn-white">Get Started</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </>
    )
}

export default Detail;