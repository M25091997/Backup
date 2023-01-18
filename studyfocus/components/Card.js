import React from 'react'
import Link from 'next/link';
import { generatePublicUrl } from '../helpers/urlConfig';
import AgencyImage from './AgencyImage';
import Image from './Image';
import { base_url } from '../helpers/urlConfig';


const Card = (props) => {
    const tutor = props.x;
    const genLinkUrl = (slug) => {
        return `${base_url}tutor-detail/${slug}`;
    }
    const genLinkUrlAgency = (slug) => {
        return `${base_url}agency-detail/${slug}`;
    }
    const renderNew = () => {
        return <span className="badge bg-primary text-center" style={{ fontSize: '10px' }}>Fresher</span>
    }
    const renderExp = (exp) => {
        // return `<span className="e-btn e-btn-2">${exp} years Experience</span>`;
        return <span className="badge bg-primary"> {exp} years Experience</span>

    }
    const renderFirst = (sub) => {
        const myArray = sub.split(",");
        return myArray[0];
    }

    const renderSubArray = (sub) => {
        const myArray = sub.split(",");
        return myArray;
    }
    return (
        <div className="col-xxl-3 col-xl-3 col-lg-3 col-md-4 grid-item cat1 cat2 cat4">
            <div className="course__item white-bg mb-30 fix">
                <div className="course__thumb w-img p-relative fix">
                    <Link href={props.type === "agency" ? genLinkUrlAgency(tutor.slug) : genLinkUrl(tutor.slug)}>
                        {
                            props.type === "agency" ? <AgencyImage width={'100%'} height={'141px'} size={'100%'} image={generatePublicUrl('subjects/' + tutor.img)} /> : <Image width={216}
                                src={generatePublicUrl('subjects/' + tutor.img)} alt="" />
                        }

                    </Link>
                    <div className="course__tag">
                        <Link href={props.type === "agency" ? genLinkUrlAgency(tutor.slug) : genLinkUrl(tutor.slug)}>{renderFirst(tutor.subjects)}</Link>
                    </div>
                </div>
                <div className="course__content" style={{ height: '187px' }}>
                    <div className="course__meta d-flex align-items-center justify-content-between">
                        <div className="course__lesson">
                            <span><i className="far fa-book-alt"></i>{tutor.sublength} Subjects</span>
                        </div>
                        <div className="course__rating">
                            <span><i className="icon_star"></i>4.5 (44)</span>
                        </div>
                    </div>
                    <h3 className="course__title">
                        {/* <Link href={genLinkUrl(tutor.slug)}>
                                                {(tutor.description.length < 28) ? tutor.description : tutor.description.slice(0, 28) + '...'}
                                            </Link> */}
                        {
                            props.type == "agency" ?
                                <span className="badge bg-primary text-center" style={{ fontSize: '10px' }}><i className="fa fa-map-marker" aria-hidden="true"></i> {tutor.cityname == "" || tutor.cityname == null ? "India" : tutor.cityname}</span>
                                : tutor.experience == 0 ? renderNew() : renderExp(tutor.experience)
                        }
                    </h3>
                    <div className="course__teacher d-flex align-items-center">
                        <div className="course__teacher-thumb mr-15">
                            <img src={generatePublicUrl('newtutor/' + tutor.profile)} alt="" />
                        </div>
                        <h6>
                            <Link href={props.type === "agency" ? genLinkUrlAgency(tutor.slug) : genLinkUrl(tutor.slug)}>
                                {props.type == "agency" ? tutor.name.substring(0, 10) + '...' : tutor.name.substring(0, 10) + '...'}
                            </Link>
                        </h6>
                    </div>
                    {

                        renderSubArray(tutor.subjects).length > 0 ?
                            renderSubArray(tutor.subjects).slice(0, 2).map(i =>
                                <span className="badge bg-warning text-center" style={{ fontSize: '10px', marginRight: '3px', backgroundColor: '#4762a7' }}>{i.substring(0, 5) + '...'}</span>
                            ) : null
                    }
                    {
                        tutor.sublength - 3 > 0 ? <span className="badge bg-warning text-center" style={{ fontSize: '10px', marginRight: '3px', backgroundColor: '#4762a7' }}>+ {tutor.sublength - 3} more</span> : null
                    }


                </div>
                <div className="course__more d-flex justify-content-between align-items-center">
                    <div className="course__status">
                        <span style={{ fontSize: '11px' }}><i className="fa fa-inr" aria-hidden="true"></i> {tutor.fee_range}</span>
                    </div>
                    <div className="course__btn">
                        <Link href={props.type === "agency" ? genLinkUrlAgency(tutor.slug) : genLinkUrl(tutor.slug)}>
                            <span className="btn btn-primary" style={{ fontSize: '10px' }}>Enquiry <i className="far fa-arrow-right"></i></span>
                        </Link>

                    </div>
                </div>
            </div>
        </div>
    )
}

export default Card;
