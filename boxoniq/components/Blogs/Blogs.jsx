import Link from "next/link";
import Blogscontent from "./sections/Blogscontent";

const Blogs = () => {
  return (
    <div>
      <div className="new-blog-section position-relative">
        <div className="new-blog-picture"></div>
        <div className="new-blog-information container-fluid">
              <div className="row">
                <div className="col-lg-12">
                  <div className="blog-heading">
                    <h1 className="blog-title text-center">Blog</h1>
                    <p className="blog-para text-center">
                      Lorem Ipsum is simply dummy text of the printing and
                      typesetting industry. Lorem Ipsum has been the
                      industry&apos;s standard dummy text ever since the 1500s,
                      when an unknown printer took.
                    </p>
                  </div>
                </div>
              </div>
              <div className="new-blog-details pb-5">
                <div className="row">
                  <Blogscontent/>
                </div>
              </div>
        </div>
      </div>
    </div>
  );
};

export default Blogs;
