import { useState, useEffect } from "react";
import axios from "axios";
import { useRouter } from 'next/router'

const Blog = () => {
  const router = useRouter();
  const { bid } = router.query; 
  console.log(bid,'nik');

  const [blogData, setBlogData] = useState({});
  const blog_data = {
    blog_slug: bid
  }

  const getBlogDetail = async () => {
    try {
      const response = await axios({
        method: "POST",
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/get-blog-detail.php",
        data: blog_data
      });
      // console.log(response, 'hulu');
      setBlogData(response.data);
    } catch (err) {
      console.log(err);
    }
  };

  useEffect(() => {
    if(bid != undefined){
      getBlogDetail();
    }
  }, []);

  return (
    <section className="blog-area">
      <div className="blog-section position-relative">
        <div className="blog-background"></div>
        <div className="blog-content">
          <div className="row">
            <div className="col-lg-12">
              <div className="blog-title text-center">
                <h1>Blog</h1>
              </div>
            </div>
          </div>
          <div className="row d-flex align-items-center justify-content-center">
            <div className="col-lg-8">
              <div className="blog-content text-center position-relative">
                <div className="image-blog">
                  <img
                    className="img-fluid"
                    src={blogData.img}
                    alt=""
                  />
                </div>
                <div className="content-blog">
                  <p>
                    {blogData.blog_desc}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
};

export default Blog;
