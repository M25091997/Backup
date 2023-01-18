import Image from 'next/image'
export default function BrandArea() {
    return (
        <>
            <section className="brand__area pb-110">
                <div className="container">
                    <div className="row">
                        <div className="col-xxl-12">
                            <div className="brand__content text-center">
                                <h3 className="brand__title">Trusted by 100 world&apos;s best companies</h3>
                            </div>
                        </div>
                    </div>
                    <div className="row">
                        <div className="col-xxl-12">
                            <div className="brand__slider swiper-container">
                                <div className="swiper-wrapper">
                                    <div className="swiper-slide">
                                        <div className="brand__item text-center text-lg-start">
                                            <Image src="/assets/img/brand/brand-1.png" alt="" width={70} height={49} />
                                        </div>
                                    </div>
                                    <div className="swiper-slide">
                                        <div className="brand__item text-center text-lg-start">
                                            <Image src="/assets/img/brand/brand-2.png" alt="" width={70} height={49} />
                                        </div>
                                    </div>
                                    <div className="swiper-slide">
                                        <div className="brand__item text-center text-lg-start">
                                            <Image src="/assets/img/brand/brand-3.png" alt="" width={70} height={49} />
                                        </div>
                                    </div>
                                    <div className="swiper-slide">
                                        <div className="brand__item text-center text-lg-start">
                                            <Image src="/assets/img/brand/brand-4.png" alt="" width={70} height={49} />
                                        </div>
                                    </div>
                                    <div className="swiper-slide">
                                        <div className="brand__item text-center text-lg-start">
                                            <Image src="/assets/img/brand/brand-5.png" alt="" width={70} height={49} />
                                        </div>
                                    </div>
                                    <div className="swiper-slide">
                                        <div className="brand__item text-center text-lg-start">
                                            <Image src="/assets/img/brand/brand-6.png" alt="" width={70} height={49} />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className="row">
                        <div className="col-xxl-12">
                            <div className="brand__more text-center">
                                <a href="about.html" className="link-btn">
                                    View all partners
                           <i className="far fa-arrow-right"></i>
                                    <i className="far fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </>
    )
}