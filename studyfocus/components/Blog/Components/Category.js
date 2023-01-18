import React from 'react'
import { useDispatch, useSelector } from 'react-redux';
import Shim from '../../Shim';



const Category = () => {
    const dispatch = useDispatch();
    const blogsData = useSelector(state => state.blogsData);
    return (
        <div className="sidebar__widget-content">
            <div className="sidebar__category">
                <ul>
                    {
                        blogsData.subs && blogsData.subs.length > 0 ?
                            blogsData.subs.slice(0, 6).map(sub =>
                                <li><a href="/blog">{sub.subject_name}</a></li>

                            ) :
                            <>
                                <Shim height={'50px'} border={'4px'} grid={'col-xs-12 col-xl-12 col-lg-12 col-md-12'} />
                                <Shim height={'50px'} border={'4px'} grid={'col-xs-12 col-xl-12 col-lg-12 col-md-12'} />
                                <Shim height={'50px'} border={'4px'} grid={'col-xs-12 col-xl-12 col-lg-12 col-md-12'} />
                                <Shim height={'50px'} border={'4px'} grid={'col-xs-12 col-xl-12 col-lg-12 col-md-12'} />

                            </>
                    }

                </ul>
            </div>
        </div>
    )
}
export default Category;