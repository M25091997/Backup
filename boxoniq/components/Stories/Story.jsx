import { useState, useEffect } from "react";
import axios from "axios";
import { useRouter } from 'next/router'

const Story = () => {
  const router = useRouter();
  const { sid } = router.query;
  console.log(sid, 'nik');

  const [storyData, setStoryData] = useState({});
  const blog_data = {
    story_slug: sid
  }

  const getStoryDetail = async () => {
    try {
      const response = await axios({
        method: "POST",
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/get-story-detail.php",
        data: blog_data
      });
      console.log(response, 'hulu');
      setStoryData(response.data);
    } catch (err) {
      console.log(err);
    }
  };

  useEffect(() => {
    if (sid != undefined) {
      getStoryDetail();
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
                <h1>{storyData.title}</h1>
              </div>
            </div>
          </div>
          <div className="row d-flex align-items-center justify-content-center">
            <div className="col-lg-8">
              <div className="blog-content text-center position-relative">
                <div className="image-blog">
                  <img
                    className="img-fluid"
                    src={storyData.img}
                    alt=""
                  />
                </div>
                <div className="content-blog">
                  <p>
                    {storyData.story}
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

export default Story;
