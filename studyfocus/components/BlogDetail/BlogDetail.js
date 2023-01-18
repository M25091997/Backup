import React from 'react'
import MainBlogDetail from './components/MainBlogDetail'
import SidebarBlog from './components/SidebarBlog'
import { useDispatch, useSelector } from 'react-redux';
import moment from 'moment';
import { generatePublicUrl } from '../../helpers/urlConfig';

const BlogDetail = () => {
    const singleBlog = useSelector(state => state.singleBlogData);

    return (
        <>
            {
                singleBlog.singleblog.length > 0 ? singleBlog.singleblog.map(single =>
                    <section className="page__title-area page__title-height-2 page__title-overlay d-flex align-items-center top_head_section"
                    // style={{ minHeight: '150px' }} 
                    >
                        {/* <div className="page__title-shape">
                            <img className="page-title-shape-1" src="/assets/img/page-title/page-title-shape-1.png" alt="" />
                            <img className="page-title-shape-2" src="/assets/img/page-title/page-title-shape-2.png" alt="" />
                            <img className="page-title-shape-3" src="/assets/img/page-title/page-title-shape-3.png" alt="" />
                            <img className="page-title-shape-4" src="/assets/img/page-title/page-title-shape-4.png" alt="" />
                        </div> */}
                        <div className="container">
                            <div className="row">
                                <div className="col-xxl-4 col-xl-4 col-lg-4 ">

                                    <div className="page__title-wrapper mt-110">
                                        <span className="page__title-pre">{single.category}</span>
                                        <h3 className="page__title-2">{single.blog_title}</h3>
                                        <div className="blog__meta d-flex align-items-center">
                                            <div className="blog__author d-flex align-items-center mr-40">
                                                <div className="blog__author-thumb mr-10">
                                                    <img src={generatePublicUrl('newblog/' + single.blog_photo)} alt="" />
                                                </div>
                                                <div className="blog__author-info blog__author-info-2">
                                                    <h5 style={{color:'#000'}}>Sumeet Saurabh</h5>
                                                </div>
                                            </div>
                                            <div className="blog__date blog__date-2 d-flex align-items-center">
                                                <i className="fal fa-clock"></i>
                                                <span style={{ color: '#000' }}>
                                                    {

                                                        moment(Date.parse(single.created_at)).format('ll')

                                                    }
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {/* <div className="col-xxl-8 col-xl-8 col-lg-8">
                                    <div className = "blog-img-detail"
                                        style={{
                                            width:'100%',
                                            height:'100%',
                                            marginTop: '100px',
                                            backgroundImage: `url(${generatePublicUrl('newblog/' + single.blog_photo)})`,
                                            backgroundPosition: 'center',
                                            backgroundRepeat: 'no-repeat',
                                            backgroundSize: 'cover'
                                        }}
                                    >

                                    </div>
                                </div> */}

                            </div>
                        </div>
                    </section>
                ) : ""
            }

            <section className="blog__area pt-120 pb-120">
                <div className="container">
                    <div className="row">
                        <div className="col-xxl-8 col-xl-8 col-lg-8">
                            <MainBlogDetail />
                        </div>
                        <div className="col-xxl-4 col-xl-4 col-lg-4">
                            <SidebarBlog />
                        </div>
                    </div>
                </div>
            </section>

        </>
    )
}

export default BlogDetail;