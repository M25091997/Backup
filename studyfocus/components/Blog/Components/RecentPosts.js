import React from 'react'
import { useSelector } from 'react-redux';
import { generatePublicUrl } from '../../../helpers/urlConfig';
import moment from 'moment';
import Link from 'next/link'
import Shim from '../../Shim';


const RecentPosts = () => {
    const blogsData = useSelector(state => state.blogsData);
    return (
        <>
            <div className="sidebar__widget-content">
                <div className="rc__post-wrapper">
                    {
                        blogsData.blogs.length > 0 ?
                            blogsData.blogs.slice(0, 3).map(blog =>
                                <div className="rc__post d-flex align-items-center">
                                    <div className="rc__thumb mr-20">
                                        <Link href="blog-details.html"><img src={generatePublicUrl('newblog/' + blog.blog_photo)} alt="" /></Link>
                                    </div>
                                    <div className="rc__content">
                                        <div className="rc__meta">
                                            <span>
                                                {

                                                    moment(Date.parse(blog.created_at)).format('ll')

                                                }
                                            </span>
                                        </div>
                                        <h6 className="rc__title"><Link href="blog-details.html">The Importance  Intrinsic Motivation.</Link></h6>
                                    </div>
                                </div>
                            ) :
                            <>
                                <Shim height={'100px'} border={'4px'} grid={'col-xs-12 col-xl-12 col-lg-12 col-md-12'} />
                                <Shim height={'100px'} border={'4px'} grid={'col-xs-12 col-xl-12 col-lg-12 col-md-12'} />
                                <Shim height={'100px'} border={'4px'} grid={'col-xs-12 col-xl-12 col-lg-12 col-md-12'} />
                                <Shim height={'100px'} border={'4px'} grid={'col-xs-12 col-xl-12 col-lg-12 col-md-12'} />

                            </>
                    }
                </div>
            </div>
        </>
    )
}
export default RecentPosts;