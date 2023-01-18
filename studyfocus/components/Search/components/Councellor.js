import React, { useEffect, useState } from 'react'
import { useSelector } from 'react-redux';
import { generatePublicUrl } from '../../../helpers/urlConfig';
import Link from 'next/link'


export default function Agency() {
    const [to, setTo] = useState(6);
    const [from, setFrom] = useState(0);
    const councellorData = useSelector(state => state.searchTutorAgency);
    let Pagination = () => {
        // if (!blogsData.blogs) return "";
        return <ul className="d-flex align-items-center">{Array.from(Array(parseInt(councellorData.tutors.length / 6)), (e, i) => {
            return <li onClick={() => getPage(i + 1)} key={i} className="">
                <a>
                    <span>{i + 1}</span>
                </a>
            </li>
        })}</ul>
    }
    const getPage = (page) => {
        // if (blogsData.blogs.length > to) {
        setFrom((page - 1) * 6);
        setTo((page) * 6);

        // }
        console.log(page);
    }
    const genLinkUrl = (slug) => {
        return `tutor-detail/${slug}`;
    }

    return (
        <div className="row grid">
            {
                councellorData.councellor && councellorData.councellor.length > 0 ?
                    councellorData.councellor.slice(from, to).map(tutor =>
                        <div className="col-xxl-3 col-xl-3 col-lg-3 col-md-4 grid-item cat1 cat2 cat4">
                            <div className="course__item white-bg mb-30 fix">
                                <div className="course__thumb w-img p-relative fix">
                                    <Link href={genLinkUrl(tutor.slug)}>
                                        <img width={216} height={129} src={generatePublicUrl('newtutor/' + tutor.profile)} alt="" />
                                    </Link>
                                    <div className="course__tag">
                                        <Link href={genLinkUrl(tutor.slug)}> Art & Design</Link>
                                    </div>
                                </div>
                                <div className="course__content" style={{ height: '187px' }}>
                                    <div className="course__meta d-flex align-items-center justify-content-between">
                                        <div className="course__lesson">
                                            <span><i className="far fa-book-alt"></i>43 Lesson</span>
                                        </div>
                                        <div className="course__rating">
                                            <span><i className="icon_star"></i>4.5 (44)</span>
                                        </div>
                                    </div>
                                    <h3 className="course__title">
                                        <Link href={genLinkUrl(tutor.slug)}>
                                            {(tutor.description.length < 28) ? tutor.description : tutor.description.slice(0, 28) + '...'}
                                        </Link>
                                    </h3>
                                    <div className="course__teacher d-flex align-items-center">
                                        <div className="course__teacher-thumb mr-15">
                                            <img src={generatePublicUrl('newtutor/' + tutor.profile)} alt="" />
                                        </div>
                                        <h6>
                                            <Link href={genLinkUrl(tutor.slug)}>
                                                {tutor.name + ' ' + tutor.l_name}
                                            </Link>
                                        </h6>
                                    </div>
                                </div>
                                <div className="course__more d-flex justify-content-between align-items-center">
                                    <div className="course__status">
                                        <span>Free</span>
                                    </div>
                                    <div className="course__btn">
                                        <a href="course-details.html" className="link-btn">
                                            Know Details
                                            <i className="far fa-arrow-right"></i>
                                            <i className="far fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    ) : <center><h3>No Councellor available with this search data</h3></center>
            }

            <div className="row">
                <div className="col-xxl-12">
                    <div className="basic-pagination wow fadeInUp mt-30" data-wow-delay=".2s">
                        <Pagination />
                    </div>
                </div>
            </div>
        </div>
    )
}