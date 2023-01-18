import Image from 'next/image'

export default function AboutArea() {
    return (
        <>
            <section className="about__area pt-120 pb-150">
                <div className="container">
                    <div className="row">
                        <div className="col-xxl-5 offset-xxl-1 col-xl-6 col-lg-6">
                            <div className="about__thumb-wrapper">

                                <div className="about__review">
                                    <h5> <span>8,200+</span> five ster reviews</h5>
                                </div>
                                <div className="about__thumb ml-100">
                                    <Image src="/assets/img/about/about.jpg" alt="" width={370} height={440} />
                                </div>
                                <div className="about__banner mt--210">
                                    <Image src="/assets/img/about/about-banner.jpg" alt="" width={240} height={310} />
                                </div>
                                <div className="about__student ml-270 mt--80">
                                    <a href="#">
                                        <Image src="/assets/img/about/student-4.jpg" alt="" width={500} height={500} />
                                        <Image src="/assets/img/about/student-3.jpg" alt="" width={500} height={500} />
                                        <Image src="/assets/img/about/student-2.jpg" alt="" width={500} height={500} />
                                        <Image src="/assets/img/about/student-1.jpg" alt="" width={500} height={500} />
                                    </a>
                                    <p>Join over <span>4,000+</span> students</p>
                                </div>
                            </div>
                        </div>
                        <div className="col-xxl-6 col-xl-6 col-lg-6">
                            <div className="about__content pl-70 pr-60 pt-25">
                                <div className="section__title-wrapper mb-25">
                                    <h2 className="section__title">Achieve your <br /><span className="yellow-bg-big">Goals <Image src="/assets/img/shape/yellow-bg-2.png" alt="" width={500} height={500} /></span>  with Educal </h2>
                                    <p>Lost the plot bobby such a fibber bleeding bits and bobs don&apos;t get shirty with me bugger all mate chinwag super pukka william barney, horse play buggered.</p>
                                </div>
                                <div className="about__list mb-35">
                                    <ul>
                                        <li className="d-flex align-items-center"> <i className="icon_check"></i> Upskill your organization.</li>
                                        <li className="d-flex align-items-center"> <i className="icon_check"></i> Access more then 100K online courses</li>
                                        <li className="d-flex align-items-center"> <i className="icon_check"></i> Learn the latest skills</li>
                                    </ul>
                                </div>
                                <a href="contact.html" className="e-btn e-btn-border">apply now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </>
    )
}