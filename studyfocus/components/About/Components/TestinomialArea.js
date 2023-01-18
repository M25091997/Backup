import Image from 'next/image'
export default function TestinomialArea() {
    return (
        <>
            <section className="testimonial__area pt-145 pb-150" style={{ backgroundImage: 'url(assets/img/testimonial/home-3/testimonial-bg-3.jpg)' }}>
                <div className="container">
                    <div className="row">
                        <div className="col-xxl-6 col-xl-6 col-lg-6 col-md-10">
                            <div className="testimonial__slider-3">
                                <h3 className="testimonial__title">Student <br /> Community Feedback</h3>
                                <div className="testimonial__slider-wrapper swiper-container testimonial-text mb-35">
                                    <div className="swiper-wrapper">
                                        <div className="swiper-slide">
                                            <div className="testimonial__item-3">
                                                <p>“After I started learning design with Quillow, I realized that I had improved to
                                                very advanced levels. While I am studying at my university, I design as an
                                                additional
                                        income and I am sure that I will do this professionally.”</p>

                                                <div className="testimonial__info-2">
                                                    <h4>James Lee,</h4>
                                                    <span>Student @Educal University</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div className="swiper-slide">
                                            <div className="testimonial__item-3">
                                                <p>“After I started learning design with Quillow, I realized that I had improved to
                                                very advanced levels. While I am studying at my university, I design as an
                                                additional
                                        income and I am sure that I will do this professionally.”</p>

                                                <div className="testimonial__info-2">
                                                    <h4>James Lee,</h4>
                                                    <span>Student @Educal University</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div className="swiper-slide">
                                            <div className="testimonial__item-3">
                                                <p>“After I started learning design with Quillow, I realized that I had improved to
                                                very advanced levels. While I am studying at my university, I design as an
                                                additional
                                        income and I am sure that I will do this professionally.”</p>

                                                <div className="testimonial__info-2">
                                                    <h4>James Lee,</h4>
                                                    <span>Student @Educal University</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div className="swiper-container testimonial-nav">
                                    <div className="swiper-wrapper">
                                        <div className="swiper-slide">
                                            <div className="testimonial__nav-thumb">
                                                <img src="/assets/img/testimonial/home-3/testi-1.jpg" alt="" width={70} height={70} />
                                            </div>
                                        </div>
                                        <div className="swiper-slide">
                                            <div className="testimonial__nav-thumb">
                                                <img src="/assets/img/testimonial/home-3/testi-2.jpg" alt="" width={70} height={70} />
                                            </div>
                                        </div>
                                        <div className="swiper-slide">
                                            <div className="testimonial__nav-thumb">
                                                <img src="/assets/img/testimonial/home-3/testi-3.jpg" alt="" width={70} height={70} />
                                            </div>
                                        </div>
                                        <div className="swiper-slide">
                                            <div className="testimonial__nav-thumb">
                                                <img src="/assets/img/testimonial/home-3/testi-2.jpg" alt="" width={70} height={70} />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="col-xxl-6 col-xl-6 col-lg-6 col-md-10">
                            <div className="testimonial__video ml-70 fix">
                                <div className="testimonial__thumb-3">
                                    <iframe src="https://www.youtube.com/embed/Rr0uFzAOQus" title="YouTube video player"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>
                                </div>
                                <div className="testimonial__video-content d-sm-flex">
                                    <div className="testimonial__video-icon mr-20 mb-20">
                                        <span>

                                        </span>
                                    </div>
                                    <div className="testimonial__video-text">
                                        <h4>Course Outcome</h4>
                                        <p>Faff about A bit of how&apos;s your father getmate cack codswallop crikey argy-bargy cobblers
                                lost his bottle.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </>
    )
}