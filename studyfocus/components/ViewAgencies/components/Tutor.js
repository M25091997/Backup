import React, { useEffect, useState } from 'react'
import { useSelector } from 'react-redux';
import { generatePublicUrl } from '../../../helpers/urlConfig';
import Link from 'next/link'
import Shim from '../../Shim';
import Card from '../../Card';
import { base_url } from '../../../helpers/urlConfig';
import Cardads from '../../Cardads';



export default function Tutor() {
    const [to, setTo] = useState(5);
    const [from, setFrom] = useState(0);
    const agencyData = useSelector(state => state.viewAllAgency);
    let Pagination = () => {
        // if (!blogsData.blogs) return "";
        return <ul className="d-flex align-items-center">{Array.from(Array(parseInt(agencyData.agency.length / 5)), (e, i) => {
            return <li onClick={() => getPage(i + 1)} key={i} className="">
                <a>
                    <span>{i + 1}</span>
                </a>
            </li>
        })}</ul>
    }
    const getPage = (page) => {
        // if (blogsData.blogs.length > to) {
        setFrom((page - 1) * 5);
        setTo((page) * 5);

        // }
        console.log(page);
    }
    const genLinkUrl = (slug) => {
        return `tutor-detail/${slug}`;
    }

    return (
        <>
            <div className="row grid">
                {
                    agencyData.loading ?
                        <>
                            <Shim height={'350px'} border={'4px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3'} />
                            <Shim height={'350px'} border={'4px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3'} />
                            <Shim height={'350px'} border={'4px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3'} />
                            <Shim height={'350px'} border={'4px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3'} />
                        </> :
                        agencyData.agency && agencyData.agency.length ? agencyData.agency.slice(from, to).map(tutor =>
                            // <Card x={tutor} type={"agency"} />
                            tutor.type == "agency" ? <Card x={tutor} type={"agency"} /> : <Cardads x={tutor} />
                        ) : <center><img width={'50%'} src={base_url + "/assets/img/logo/notfound.jpg"} alt="logo" /></center>

                }


            </div>
            <div className="row">
                <div className="col-xxl-12">
                    <div className="basic-pagination wow fadeInUp mt-30" data-wow-delay=".2s">
                        {
                            agencyData.agency && agencyData.agency.length ? < Pagination /> : ""

                        }
                    </div>
                </div>
            </div>
        </>
    )
}