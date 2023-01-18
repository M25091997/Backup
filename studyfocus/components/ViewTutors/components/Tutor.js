import React, { useEffect, useState } from 'react'
import { useSelector } from 'react-redux';
import { generatePublicUrl } from '../../../helpers/urlConfig';
import Link from 'next/link';
import Shim from '../../Shim';
import Card from '../../Card';
import { base_url } from '../../../helpers/urlConfig';
import Cardads from '../../Cardads';



export default function Tutor() {
    const [to, setTo] = useState(25);
    const [from, setFrom] = useState(0);

    const tutorData = useSelector(state => state.viewAllTutor);
    // let Pagination = () => {
    //     // if (!blogsData.blogs) return "";
    //     return <ul className="d-flex align-items-center">{Array.from(Array(parseInt(tutorData.tutors.length / 25)), (e, i) => {
    //         return <li onClick={() => getPage(i + 1)} key={i} className="">
    //             <a>
    //                 <span>{i + 1}</span>
    //             </a>
    //         </li>
    //     })}</ul>
    // }
    // const getPage = (page) => {

    //     setFrom((page - 1) * 25);
    //     setTo((page) * 25);
    //     console.log(page);
    // }

    return (
        <>
            <div className="row grid">
                {console.log(tutorData.tutors)}
                {
                    tutorData.loading ? <>
                        <Shim height={'350px'} border={'4px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3'} />
                        <Shim height={'350px'} border={'4px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3'} />
                        <Shim height={'350px'} border={'4px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3'} />
                        <Shim height={'350px'} border={'4px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3'} />
                    </> :
                        tutorData.tutors && tutorData.tutors.length ? tutorData.tutors.slice(from, to).map(tutor =>
                            tutor.type == "tutor" ? <Card x={tutor} /> : <Cardads x={tutor} />
                            // <Card x={tutor} />
                            // <h1>{tutor.type}</h1>
                            ) : <center><img width={'50%'} src={base_url + "/assets/img/logo/notfound.jpg"} alt="logo" /></center>
                }

            </div>
            {/* <div className="row">
                <div className="col-xxl-12">
                    <div className="basic-pagination wow fadeInUp mt-30" data-wow-delay=".2s">
                        {
                            tutorData.tutors && tutorData.tutors.length ? < Pagination /> : ""

                        }
                        
                    </div>
                </div>
            </div> */}
        </>
    )
}