import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import moment from 'moment';
import { generatePublicUrl } from '../../../helpers/urlConfig';
import Link from 'next/link'





const RelatedPosts = () => {
    const singleBlog = useSelector(state => state.singleBlogData);
    const genLinkUrl = (slug) => {
        return `${slug}`;
        // return "blog/{slug}";
    }

    return (
        <div className="blog__recent mb-65">
            <div className="section__title-wrapper mb-40">
                <h2 className="section__title">Related <span className="yellow-bg-sm">Post <img src="/assets/img/shape/yellow-bg-4.png" alt="" />  </span></h2>
                <p>You don't have to struggle alone, you've got our assistance and help.</p>
            </div>
            <div className="row">
                {
                    singleBlog.relatedblog && singleBlog.relatedblog.length > 0 ? singleBlog.relatedblog.slice(0, 4).map(single =>
                        <div className="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                            <div className="blog__item white-bg mb-30 transition-3 fix">
                                <div className="blog__thumb w-img fix">
                                    <Link href={genLinkUrl(single.blog_slug)}>
                                        <img width={336} height={238} src={generatePublicUrl('newblog/' + single.blog_photo)} alt="" />
                                    </Link>
                                </div>
                                <div className="blog__content">
                                    <div className="blog__tag">
                                        <a href="#">{single.category}</a>
                                    </div>
                                    <h3 className="blog__title">
                                        <Link href={genLinkUrl(single.blog_slug)}>{single.blog_title}</Link>
                                        </h3>

                                    <div className="blog__meta d-flex align-items-center justify-content-between">
                                        <div className="blog__author d-flex align-items-center">
                                            <div className="blog__author-thumb mr-10">
                                                <img src="/assets/img/blog/author/author-1.jpg" alt="" />
                                            </div>
                                            <div className="blog__author-info">
                                                <h5>Sumeet Saurabh</h5>
                                            </div>
                                        </div>
                                        <div className="blog__date d-flex align-items-center">
                                            <i className="fal fa-clock"></i>
                                            {

                                                moment(Date.parse(single.created_at)).format('ll')

                                            }
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ) : ""
                }
            </div>
        </div>
    )
}

export default RelatedPosts;
