import React from 'react'
import MainEnquiry from './Components/MainEnquiry'

export default function Enquiry() {
    return (
        <>
            <section
                className="page__title-area page__title-height page__title-overlay d-flex align-items-center top_head_section"
            // style={{ backgroundImage: 'url(assets/img/page-title/page-title.jpg)' }}
            // style={{ minHeight: '150px' }}

            >
                <div className="container">
                    <div className="row">
                        <div className="col-xxl-12">
                            <div className="page__title-wrapper mt-110">
                                <h3 className="page__title">Student Enquiry</h3>
                                <nav aria-label="breadcrumb">
                                    <ol className="breadcrumb">
                                        <li className="breadcrumb-item"><a href="/">Home</a></li>
                                        <li className="breadcrumb-item active" aria-current="page">Student Enquiry</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section className="blog__area pt-15 pb-120">
                <div className="container">
                    <div className="row">
                        <div className="col-xxl-12 col-xl-12 col-lg-12">
                            <MainEnquiry />
                        </div>
                    </div>
                </div>
            </section>

        </>
    )
}