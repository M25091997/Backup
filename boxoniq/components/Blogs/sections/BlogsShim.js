import React from 'react'
import BlogImageShim from './BlogeImageShim';
import BlogTitleShim from './BlogeTitleShim';



const BlogsShim = () => {
  return (
      <div className="col-lg-4 col-md-2 col-12 law-wrapper" style={{ cursor: 'pointer' }}>
          <div className="card" style={{ border: "0 !important" }}>
              <BlogImageShim />
              <div className="card-body">
                  <BlogTitleShim />
              </div>
          </div>
      </div>
  )
}

export default BlogsShim