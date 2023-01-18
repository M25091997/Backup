import React, { useEffect, useState } from 'react'
import { useDispatch, useSelector } from 'react-redux';
import { getBlogData } from '../../../redux/actions';

import Shim from '../../Shim';
import BlogCard from '../../BlogCard';

const MainBlog = () => {
    const dispatch = useDispatch();
    const blogsData = useSelector(state => state.blogsData);
    const [to, setTo] = useState(6);
    const [from, setFrom] = useState(0);
    useEffect(() => {
        dispatch(getBlogData());
    }, []);

    let App = () => {
        // if (!blogsData.blogs) return "";
        return <ul className="d-flex align-items-center">{Array.from(Array(parseInt(blogsData.blogs.length / 6)), (e, i) => {
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



    return (
        <>
            <div className="row">
                {
                    blogsData.blogs.length > 0 ?
                        blogsData.blogs.slice(from, to).map(blog =>
                            <BlogCard blog={blog} />
                        ) : <>
                            <Shim height={'350px'} border={'4px'} grid={'col-xs-12 col-xl-6 col-lg-6 col-md-6'} />
                            <Shim height={'350px'} border={'4px'} grid={'col-xs-12 col-xl-6 col-lg-6 col-md-6'} />
                            <Shim height={'350px'} border={'4px'} grid={'col-xs-12 col-xl-6 col-lg-6 col-md-6'} />
                            <Shim height={'350px'} border={'4px'} grid={'col-xs-12 col-xl-6 col-lg-6 col-md-6'} />
                        </>
                }

            </div>
            <div className="row">
                <div className="col-xxl-12">
                    <div className="basic-pagination wow fadeInUp mt-30" data-wow-delay=".2s">
                        <App />
                    </div>
                </div>
            </div>
        </>
    )
}
export default MainBlog