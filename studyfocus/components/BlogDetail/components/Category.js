import React from 'react'

const Category = () => {
    return (
        <div className="sidebar__widget mb-55">
            <div className="sidebar__widget-head mb-35">
                <h3 className="sidebar__widget-title">Category</h3>
            </div>
            <div className="sidebar__widget-content">
                <div className="sidebar__category">
                    <ul>
                        <li><a href="blog.html">Category</a></li>
                        <li><a href="blog.html">Video & Tips  (4)</a></li>
                        <li><a href="blog.html">Education  (8)</a></li>
                        <li><a href="blog.html">Business  (5)</a></li>
                        <li><a href="blog.html">UX Design  (3)</a></li>
                    </ul>
                </div>
            </div>
        </div>
    )
}
export default Category;