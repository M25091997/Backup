import React, { useState } from 'react';
import Link from 'next/link';

export default function About() {
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
                            <div className="page__title-wrapper mt-110" style={{marginTop:'150px'}}>
                                <h3 className="page__title">About</h3>
                                <nav aria-label="breadcrumb">
                                    <ol className="breadcrumb">
                                        <li className="breadcrumb-item"><Link href="/">Home</Link></li>
                                        <li className="breadcrumb-item active" aria-current="page">About</li>
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
                            <p>
                                STUDY FOCUS (accessible at <a href="https://studyfocus.in">https://studyfocus.in</a>) is a unit of S S VENTURES, a proprietorship firm based out of Ranchi, Jharkhand. S S VENTURES is owned by Mr. Sumeet Saurabh, an engineer and entrepreneur, who graduated with distinction in Civil Engineering from K.I.I.T University, Bhubaneswar.
                            </p>
                            <p>
                                Study Focus aims to provide a free platform for students/parents to directly contact and interact with home tutors, Online tutors and Coaching institutes for their tutoring and study needs. Students/Parents can contact multiple tutors without worrying about any charges or middlemen.
                            </p>
                            <p>
                                Study Focus also allows eligible home tutors, Online tutors and Institutes to register for FREE. Even skill tutors, vocational experts can join too. ( Largest selection of Subjects 100+)
                            </p>
                            <p>
                                Study Focus also allows Counselors, admission agencies and placement agencies for FREE registration. Students/Parents can also contact them FREE.
                            </p>
                            <p>
                                Study Focus, being a teacher - student website with students and tutors from all over India, offers tutors and Institutes an economical platform to advertise and brand themselves.
                                Of Late, we all have been going through some tough times due to the pandemic and education field has been the most affected. Through Study Focus, we want to play our part to help tutors and students along with others in the education field.

                            </p>
                            <p>
                                Thank you for your time to read this! We hope you will appreciate our efforts for building and maintaining this platform. Wishing you all the best!
                            </p>
                        </div>
                        
                    </div>
                </div>
            </section>

            </>
    )
}