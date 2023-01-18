import React from 'react'
import { generatePublicUrl } from '../helpers/urlConfig';
import moment from 'moment';
import Link from 'next/link';

const BlogCard = ({ blog }) => {
    const genLinkUrl = (slug) => {
        return `blog/${slug}`;
        // return "blog/{slug}";
    }
    return (
        <div className="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
            <div className="blog__wrapper">
                <div className="blog__item white-bg mb-30 transition-3 fix">
                    <div className="blog__thumb w-img fix">
                        <Link href={genLinkUrl(blog.blog_slug)}>
                            <img width={336} height={238} src={generatePublicUrl('newblog/' + blog.blog_photo)} alt="" />
                        </Link>
                    </div>
                    <div className="blog__content" style={{ height: '221px' }}>
                        <div className="blog__tag">
                            <Link href={genLinkUrl(blog.blog_slug)}>{blog.category}</Link>
                        </div>
                        <h3 className="blog__title"><Link href={genLinkUrl(blog.blog_slug)}>{(blog.blog_title.length < 40) ? blog.blog_title : blog.blog_title.slice(0, 40) + '...'}</Link></h3>

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
                                <span>
                                    {

                                        moment(Date.parse(blog.created_at)).format('ll')

                                    }
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}

export default BlogCard;