import React from 'react'
import AboutArea from './Components/AboutArea'
import BannerArea from './Components/BannerArea'
import BrandArea from './Components/BrandArea'
import Counter from './Components/Counter'
import TestinomialArea from './Components/TestinomialArea'
import WhyArea from './Components/WhyArea'
import BottomBannerArea from '../Home/BottomBannerArea'

export default function About() {
    return (
        <>
            <section className="page__title-area page__title-height page__title-overlay d-flex align-items-center" data-background="assets/img/page-title/page-title-2.jpg">
                <div className="container">
                    <div className="row">
                        <div className="col-xxl-12">
                            <div className="page__title-wrapper mt-110">
                                <h3 className="page__title">About</h3>
                                <nav aria-label="breadcrumb">
                                    <ol className="breadcrumb">
                                        <li className="breadcrumb-item"><a href="index-2.html">Home</a></li>
                                        <li className="breadcrumb-item active" aria-current="page">About</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <AboutArea />
            <BrandArea />
            <TestinomialArea />
            <WhyArea />
            <Counter />
            <BannerArea />
            <BottomBannerArea />

        </>
    )
}