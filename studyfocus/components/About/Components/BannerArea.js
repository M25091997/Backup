import Image from 'next/image'
export default function BannerArea() {
    return (
        <>
            <section className="banner__area pb-110">
                <div className="container">
                    <div className="row">
                        <div className="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                            <div className="banner__item p-relative mb-40" style={{ backgroundImage: 'url(assets/img/banner/banner-bg-1.jpg)' }}>
                                <div className="banner__content">
                                    <span>Free</span>
                                    <h3 className="banner__title">
                                        <a href="course-details.html">Germany Foundation <br /> Document</a>
                                    </h3>
                                    <a href="course-grid.html" className="e-btn e-btn-2">View Courses</a>
                                </div>
                                <div className="banner__thumb d-none d-sm-block d-md-none d-lg-block">
                                    <Image src="/assets/img/banner/banner-img-1.png" alt="" width={570} height={260} />
                                </div>
                            </div>
                        </div>
                        <div className="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                            <div className="banner__item p-relative mb-40" data-background="assets/img/banner/banner-bg-2.jpg">
                                <div className="banner__content">
                                    <span className="orange">new</span>
                                    <h3 className="banner__title">
                                        <a href="course-details.html">Online Courses <br />From Eduka University</a>
                                    </h3>
                                    <a href="course-grid.html" className="e-btn e-btn-2">Find Out More</a>
                                </div>
                                <div className="banner__thumb banner__thumb-2 d-none d-sm-block d-md-none d-lg-block">
                                    <Image src="/assets/img/banner/banner-img-2.png" alt="" width={570} height={260} />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </>
    )
}