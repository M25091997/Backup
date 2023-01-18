import React, { useState } from 'react'
import Category from './Category'
import RecentPosts from './RecentPosts'
import Tags from './Tags'
import { useDispatch, useSelector } from 'react-redux';
import { getSearchBlog } from '../../../redux/actions';



const SidebarBlog = () => {
    const dispatch = useDispatch();
    const [search, setSearch] = useState('');

    const searchKey = (e) => {
        e.preventDefault();
        const searchkey = {
            search
        }
        dispatch(getSearchBlog(searchkey));
    }
    const runScript = (e) => {
        e.preventDefault();
        const searchkey = {
            search
        }
        if (e.keyCode == 13) {
            dispatch(getSearchBlog(searchkey));
        }

    }

    return (
        <>
            <div className="blog__sidebar pl-70">
                <div className="sidebar__widget mb-60">
                    <div className="sidebar__widget-content">
                        <div className="sidebar__search p-relative">
                            <form onSubmit={searchKey}>
                                <input
                                    type="text"
                                    placeholder="Search for blogs"
                                    onKeyUp={runScript}
                                    value={search}
                                    onChange={(e) => { setSearch(e.target.value) }}
                                />
                                <button type="submit"><i className="fad fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div className="sidebar__widget mb-55">
                    <div className="sidebar__widget-head mb-35">
                        <h3 className="sidebar__widget-title">Recent posts</h3>
                    </div>
                    <RecentPosts />
                </div>
                <div className="sidebar__widget mb-55">
                    <div className="sidebar__widget-head mb-35">
                        <h3 className="sidebar__widget-title">Categories</h3>
                    </div>
                    <Category />
                </div>
                <div className="sidebar__widget mb-55">
                    <div className="sidebar__widget-head mb-35">
                        <h3 className="sidebar__widget-title">Get Top Tutors</h3>
                    </div>
                    <Tags />
                </div>
                <div className="sidebar__widget mb-55">
                    <div className="sidebar__banner w-img">
                        <img src="/assets/img/blog/banner/banner-1.jpg" alt="" />
                    </div>
                </div>
            </div>
        </>
    )
}

export default SidebarBlog;