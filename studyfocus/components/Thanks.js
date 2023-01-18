import React from 'react'

const Thanks = () => {
    return (
        <>
            <section className="signup__area po-rel-z1 pt-100 pb-145">
                <div className="sign__shape">
                    <img className="man-1" src="/assets/img/icon/sign/man-3.png" alt="" />
                    <img className="man-2 man-22" src="/assets/img/icon/sign/man-2.png" alt="" />
                    <img className="circle" src="/assets/img/icon/sign/circle.png" alt="" />
                    <img className="zigzag" src="/assets/img/icon/sign/zigzag.png" alt="" />
                    <img className="dot" src="/assets/img/icon/sign/dot.png" alt="" />
                    <img className="bg" src="/assets/img/icon/sign/sign-up.png" alt="" />
                    <img className="flower" src="/assets/img/icon/sign/flower.png" alt="" />
                </div>
                <div className="container">
                    <div className="row">
                        <div className="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2">
                            <div className="section__title-wrapper text-center mb-55">
                                <h1>Sign Up Successful</h1>
                                <h3>You will start getting enquiries as soon as we verify your listing.</h3>

                            </div>
                        </div>
                    </div>
                    <div className="row">
                        <div className="col-xxl-6 offset-xxl-3 col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                            {/* <div className="sign__wrapper white-bg"> */}
                                <img className="img-responsive" style={{width:'85%'}} src="/assets/img/thanks.jpg" alt="" />

                               
                            {/* </div> */}
                        </div>
                    </div>
                </div>
            </section>
        </>
    )
}

export default Thanks;
