import React, { useState } from 'react';
import Link from 'next/link';

export default function Privacy() {
    // const [name, setName] = useState('');
    // const [email, setEmail] = useState('');
    // const [msg, setMsg] = useState('');
    // const [subject, setSubject] = useState('');


    // const userSignup = (e) => {
    //     e.preventDefault();
    //     // const user = {
    //     //     selectedFile, name, email, msg, subject, mobile, state, scity, medium, cls, platform, board, description
    //     // }
    //     const formData = new FormData();
    //     formData.append('name', name);
    //     formData.append('email', email);
    //     formData.append('subject', subject);
    //     formData.append('msg', msg);

    //     console.log(formData);
    //     // return false;
    //     axios.post('https://studyfocus.in/cybertechMedia/api/new-study-api/register/enquiry-api.php', formData)
    //         .then(function (response) {
    //             //handle success
    //             if (response.data.status == 201) {
    //                 alert('Thank you for contacting. We will get back to you soon');
    //             }

    //         })
    //         .catch(function (response) {
    //             //handle error
    //             console.log(response)
    //             console.log("sorry")
    //         });

    //     setName('');
    //     setEmail('');
    //     setMsg('');
    //     setSubject('');

    // }
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
                                <h3 className="page__title">Privacy Policy Section</h3>
                                <nav aria-label="breadcrumb">
                                    <ol className="breadcrumb">
                                        <li className="breadcrumb-item"><Link href="/">Home</Link></li>
                                        <li className="breadcrumb-item active" aria-current="page">Privacy Policy</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section className="contact__area pt-15 pb-120">
                <div className="container">
                    <div className="row">
                        <div className="col-xxl-12 col-xl-12 col-lg-12">
                            <p><span style={{ fontSize: '20px', fontWeight:'bold' }}>Privacy Policy for Study Focus</span><br /><span style={{ fontSize: '14px' }}>At studyfocus.in, accessible from <a href="https://www.studyfocus.in">https://www.studyfocus.in</a>, one of our main priorities is the privacy of our visitors. This Privacy Policy document contains types of information that is collected and recorded by studyfocus.in and how we use it.</span></p>
                            <p><span style={{ fontSize: '14px' }}>If you have additional questions or require more information about our Privacy Policy, do not hesitate to contact us.</span></p>
                            <p><span style={{ fontSize: '14px' }}>This Privacy Policy applies only to our online activities and is valid for visitors to our website with regards to the information that they shared and/or collect in studyfocus.in. This policy is not applicable to any information collected offline or via channels other than this website. Our Privacy Policy was created with the help of the Online Generator of Privacy Policy.</span></p>
                            <p><span style={{ fontSize: '14px' }}>Consent</span><br /><span style={{ fontSize: '14px' }}>By using our website, you hereby consent to our Privacy Policy and agree to its terms.</span></p>
                            <p><span style={{ fontSize: '14px' }}>Information we collect</span><br /><span style={{ fontSize: '14px' }}>The personal information that you are asked to provide, and the reasons why you are asked to provide it, will be made clear to you at the point we ask you to provide your personal information.</span></p>
                            <p><span style={{ fontSize: '14px' }}>If you contact us directly, we may receive additional information about you such as your name, email address, phone number, the contents of the message and/or attachments you may send us, and any other information you may choose to provide.</span></p>
                            <p><span style={{ fontSize: '14px' }}>When you register for an Account, we may ask for your contact information, including items such as name, company name, address, email address, and telephone number.</span></p>
                            <p><span style={{ fontSize: '14px' }}>How we use your information</span><br /><span style={{ fontSize: '14px' }}>We use the information we collect in various ways, including to:</span></p>
                            <p><span style={{ fontSize: '14px' }}>Provide, operate, and maintain our website</span><br /><span style={{ fontSize: '14px' }}>Improve, personalize, and expand our website</span><br /><span style={{ fontSize: '14px' }}>Understand and analyze how you use our website</span><br /><span style={{ fontSize: '14px' }}>Develop new products, services, features, and functionality</span><br /><span style={{ fontSize: '14px' }}>Communicate with you, either directly or through one of our partners, including for customer service, to provide you with updates and other information relating to the website, and for marketing and promotional purposes</span><br /><span style={{ fontSize: '14px' }}>Send you emails</span><br /><span style={{ fontSize: '14px' }}>Find and prevent fraud</span><br /><span style={{ fontSize: '14px' }}>Log Files</span><br /><span style={{ fontSize: '14px' }}>studyfocus.in follows a standard procedure of using log files. These files log visitors when they visit websites. All hosting companies do this and a part of hosting services' analytics. The information collected by log files include internet protocol (IP) addresses, browser type, Internet Service Provider (ISP), date and time stamp, referring/exit pages, and possibly the number of clicks. These are not linked to any information that is personally identifiable. The purpose of the information is for analyzing trends, administering the site, tracking users' movement on the website, and gathering demographic information.</span></p>
                            <p><span style={{ fontSize: '14px' }}>Cookies and Web Beacons</span><br /><span style={{ fontSize: '14px' }}>Like any other website, studyfocus.in uses 'cookies'. These cookies are used to store information including visitors' preferences, and the pages on the website that the visitor accessed or visited. The information is used to optimize the users' experience by customizing our web page content based on visitors' browser type and/or other information.</span></p>
                            <p><span style={{ fontSize: '14px' }}>For more general information on cookies, please read "What Are Cookies" from Cookie Consent.</span></p>
                            <p><span style={{ fontSize: '14px' }}>Google DoubleClick DART Cookie</span><br /><span style={{ fontSize: '14px' }}>Google is one of a third-party vendor on our site. It also uses cookies, known as DART cookies, to serve ads to our site visitors based upon their visit to <a href="www.website.com" aria-invalid="true">www.website.com</a> and other sites on the internet. However, visitors may choose to decline the use of DART cookies by visiting the Google ad and content network Privacy Policy at the following URL &ndash; <a href="https://policies.google.com/technologies/ads">https://policies.google.com/technologies/ads</a></span></p>
                            <p><span style={{ fontSize: '14px' }}>Our Advertising Partners</span><br /><span style={{ fontSize: '14px' }}>Some of advertisers on our site may use cookies and web beacons. Our advertising partners are listed below. Each of our advertising partners has their own Privacy Policy for their policies on user data. For easier access, we hyperlinked to their Privacy Policies below.</span></p>
                            <p><span style={{ fontSize: '14px' }}>Google</span></p>
                            <p><span style={{ fontSize: '14px' }}><a href="https://policies.google.com/technologies/ads">https://policies.google.com/technologies/ads</a></span></p>
                            <p><span style={{ fontSize: '14px' }}>Advertising Partners Privacy Policies</span><br /><span style={{ fontSize: '14px' }}>You may consult this list to find the Privacy Policy for each of the advertising partners of studyfocus.in.</span></p>
                            <p><span style={{ fontSize: '14px' }}>Third-party ad servers or ad networks uses technologies like cookies, JavaScript, or Web Beacons that are used in their respective advertisements and links that appear on studyfocus.in, which are sent directly to users' browser. They automatically receive your IP address when this occurs. These technologies are used to measure the effectiveness of their advertising campaigns and/or to personalize the advertising content that you see on websites that you visit.</span></p>
                            <p><span style={{ fontSize: '14px' }}>Note that studyfocus.in has no access to or control over these cookies that are used by third-party advertisers.</span></p>
                            <p><span style={{ fontSize: '14px' }}>Third Party Privacy Policies</span><br /><span style={{ fontSize: '14px' }}>studyfocus.in's Privacy Policy does not apply to other advertisers or websites. Thus, we are advising you to consult the respective Privacy Policies of these third-party ad servers for more detailed information. It may include their practices and instructions about how to opt-out of certain options.</span></p>
                            <p><span style={{ fontSize: '14px' }}>You can choose to disable cookies through your individual browser options. To know more detailed information about cookie management with specific web browsers, it can be found at the browsers' respective websites.</span></p>
                            <p><span style={{ fontSize: '14px' }}>CCPA Privacy Rights (Do Not Sell My Personal Information)</span><br /><span style={{ fontSize: '14px' }}>Under the CCPA, among other rights, California consumers have the right to:</span></p>
                            <p><span style={{ fontSize: '14px' }}>Request that a business that collects a consumer's personal data disclose the categories and specific pieces of personal data that a business has collected about consumers.</span></p>
                            <p><span style={{ fontSize: '14px' }}>Request that a business delete any personal data about the consumer that a business has collected.</span></p>
                            <p><span style={{ fontSize: '14px' }}>Request that a business that sells a consumer's personal data, not sell the consumer's personal data.</span></p>
                            <p><span style={{ fontSize: '14px' }}>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.</span></p>
                            <p><span style={{ fontSize: '14px' }}>GDPR Data Protection Rights</span><br /><span style={{ fontSize: '14px' }}>We would like to make sure you are fully aware of all of your data protection rights. Every user is entitled to the following:</span></p>
                            <p><span style={{ fontSize: '14px' }}>The right to access &ndash; You have the right to request copies of your personal data. We may charge you a small fee for this service.</span></p>
                            <p><span style={{ fontSize: '14px' }}>The right to rectification &ndash; You have the right to request that we correct any information you believe is inaccurate. You also have the right to request that we complete the information you believe is incomplete.</span></p>
                            <p><span style={{ fontSize: '14px' }}>The right to erasure &ndash; You have the right to request that we erase your personal data, under certain conditions.</span></p>
                            <p><span style={{ fontSize: '14px' }}>The right to restrict processing &ndash; You have the right to request that we restrict the processing of your personal data, under certain conditions.</span></p>
                            <p><span style={{ fontSize: '14px' }}>The right to object to processing &ndash; You have the right to object to our processing of your personal data, under certain conditions.</span></p>
                            <p><span style={{ fontSize: '14px' }}>The right to data portability &ndash; You have the right to request that we transfer the data that we have collected to another organization, or directly to you, under certain conditions.</span></p>
                            <p><span style={{ fontSize: '14px' }}>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.</span></p>
                            <p><span style={{ fontSize: '14px' }}>Children's Information</span><br /><span style={{ fontSize: '14px' }}>Another part of our priority is adding protection for children while using the internet. We encourage parents and guardians to observe, participate in, and/or monitor and guide their online activity.</span></p>
                            <p><span style={{ fontSize: '14px' }}>studyfocus.in does not knowingly collect any Personal Identifiable Information from children under the age of 13. If you think that your child provided this kind of information on our website, we strongly encourage you to contact us immediately and we will do our best efforts to promptly remove such information from our records.</span></p>
                        </div>

                    </div>
                </div>
            </section>

        </>
    )
}