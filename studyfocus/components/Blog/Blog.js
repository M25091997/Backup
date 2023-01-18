import React from 'react'
import MainBlog from './Components/MainBlog'
import SidebarBlog from './Components/SidebarBlog'

export default function Blog() {
    return (
        <>
            <section
                className="page__title-area page__title-height page__title-overlay d-flex align-items-center top_head_section"
            // style={{ backgroundImage: 'url(assets/img/page-title/page-title.jpg)' }}
            // style={{ minHeight: '150px' }}

            >
                <div className="container">
                    <div className="row">
                        <div className="col-xxl-12">
                            <div className="page__title-wrapper mt-110">
                                <h3 className="page__title">Blog</h3>
                                <nav aria-label="breadcrumb">
                                    <ol className="breadcrumb">
                                        <li className="breadcrumb-item"><a href="index-2.html">Home</a></li>
                                        <li className="breadcrumb-item active" aria-current="page">Blog</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section className="blog__area pt-15 pb-120">
                <div className="container">
                    <div className="row">
                        <div className="col-xxl-8 col-xl-8 col-lg-8">
                            <MainBlog />
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