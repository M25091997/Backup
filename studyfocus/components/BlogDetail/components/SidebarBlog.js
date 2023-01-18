import React from 'react'
import Category from './Category'
import RecentPosts from '../../Blog/Components/RecentPosts'
import Tags from './Tags'

const SidebarBlog = () => {
    return (
        <div className="blog__sidebar pl-70">
            <div className="sidebar__widget mb-55">
                <div className="sidebar__widget-head mb-35">
                    <h3 className="sidebar__widget-title">Recent posts</h3>
                </div>
                <RecentPosts />
            </div>
            <Category />
            <Tags />
            <div className="sidebar__widget mb-55">
                <div className="sidebar__banner w-img">
                    <img src="/assets/img/blog/banner/banner-1.jpg" alt="" />
                </div>
            </div>
        </div>
    )
}

export default SidebarBlog;