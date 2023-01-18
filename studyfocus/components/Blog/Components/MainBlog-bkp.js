import React, { useEffect } from 'react'
import { useDispatch, useSelector } from 'react-redux';
import { getBlogData } from '../../../redux/actions';
import { generatePublicUrl } from '../../../helpers/urlConfig';

const MainBlog = () => {
    const dispatch = useDispatch();
    const blogsData = useSelector(state => state.blogsData);
    useEffect(() => {
        dispatch(getBlogData());
    }, []);
    return (
        <>
            <div className="row">
                {
                    blogsData.blogs.length > 0 ?
                        blogsData.blogs.map(blog =>
                            <div className="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                                <div className="blog__wrapper">
                                    <div className="blog__item white-bg mb-30 transition-3 fix">
                                        <div className="blog__thumb w-img fix">
                                            <a href="blog-details.html">
                                                <img src={generatePublicUrl('newblog/' + blog.blog_photo)} alt="" />
                                            </a>
                                        </div>
                                        <div className="blog__content">
                                            <div className="blog__tag">
                                                <a href="#">Art & Design</a>
                                            </div>
                                            <h3 className="blog__title"><a href="blog-details.html">{blog.blog_title}</a></h3>

                                            <div className="blog__meta d-flex align-items-center justify-content-between">
                                                <div className="blog__author d-flex align-items-center">
                                                    <div className="blog__author-thumb mr-10">
                                                        <img src="/assets/img/blog/author/author-1.jpg" alt="" />
                                                    </div>
                                                    <div className="blog__author-info">
                                                        <h5>Jim Séchen</h5>
                                                    </div>
                                                </div>
                                                <div className="blog__date d-flex align-items-center">
                                                    <i className="fal fa-clock"></i>
                                                    <span>April 02, 2022</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ) : null
                }

            </div>
            <div className="row">
                <div className="col-xxl-12">
                    <div className="basic-pagination wow fadeInUp mt-30" data-wow-delay=".2s">
                        <ul className="d-flex align-items-center">
                            <li className="prev">
                                <a href="/blog" className="link-btn link-prev">
                                    Prev
                                       <i className="arrow_left"></i>
                                    <i className="arrow_left"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span>1</span>
                                </a>
                            </li>
                            <li className="active">
                                <a href="/blog">
                                    <span>2</span>
                                </a>
                            </li>
                            <li>
                                <a href="/blog">
                                    <span>3</span>
                                </a>
                            </li>
                            <li className="next">
                                <a href="/blog" className="link-btn">
                                    Next
                                       <i className="arrow_right"></i>
                                    <i className="arrow_right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </>
    )
}
export default MainBlog