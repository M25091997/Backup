import React from 'react';
import { useSelector } from 'react-redux';
import { generatePublicUrl } from '../../helpers/urlConfig';
import Link from 'next/link'

export default function Councellor() {
    const initialData = useSelector(state => state.initialData);
    const genLinkUrl = (slug) => {
        return `councellor-detail/${slug}`;
    }
    return (
        <div className="row grid">
            {
                initialData.councellors.length > 0 ?
                    initialData.councellors.map(agenc =>
                        <div className="col-xxl-3 col-xl-3 col-lg-3 col-md-4 grid-item cat1 cat2 cat4">
                            <div className="course__item white-bg mb-30 fix">
                                <div className="course__thumb w-img p-relative fix">
                                    <Link href={genLinkUrl(agenc.slug)}>
                                        <img width="216" height="129" src={generatePublicUrl('councellor/' + agenc.profile)} alt="" />
                                    </Link>
                                    <div className="course__tag">
                                        <Link href={genLinkUrl(agenc.slug)}>Art & Design</Link>
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
                                    <h3 className="course__title"><a href={genLinkUrl(agenc.slug)}>
                                        {(agenc.description.length < 28) ? agenc.description : agenc.description.slice(0, 28) + '...'}</a></h3>
                                    <div className="course__teacher d-flex align-items-center">
                                        <div className="course__teacher-thumb mr-15">
                                            <img src={generatePublicUrl('councellor/' + agenc.profile)} alt="" />
                                        </div>

                                        <h6> <Link href={genLinkUrl(agenc.slug)}>{agenc.name}</Link></h6>
                                    </div>
                                </div>
                                <div className="course__more d-flex justify-content-between align-items-center">
                                    <div className="course__status">
                                        <span>Free</span>
                                    </div>
                                    <div className="course__btn">
                                        <a href={genLinkUrl(agenc.slug)} className="link-btn">
                                            Know Details
                                            <i className="far fa-arrow-right"></i>
                                            <i className="far fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ) : null
            }

        </div>
    )
}