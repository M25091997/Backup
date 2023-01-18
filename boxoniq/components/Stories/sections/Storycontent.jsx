import { useState, useEffect } from "react";
import axios from "axios";
import Router from 'next/router'
import StoryShim from "./StoryShim";

const Storycontent = (props) => {
  const storyData = props.x;
  // const [storyData, setStoryData] = useState([]);

  const goToStory = (storyId) => {
    Router.push("stories/" + storyId);
  }

  // const getStory = () => {
  //   axios
  //     .get(
  //       "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/get-stories.php"
  //     )
  //     .then((response) => {
  //       setStoryData(response.data);
  //     })
  //     .catch((err) => {
  //       console.log(err);
  //     });
  // };

  return (
    <>
      {
        storyData && storyData.length > 0 ? storyData.map((item) => {
          return(
            <div className="row" key={item.id} onClick={() => goToStory(item.slug)} style={{ cursor: 'pointer' }}>
              <div className="col-lg-11 col-sm-10 mx-auto">
                <div className="container-fluid stories-details ">
                  <div className="row">
                    <div className="col-lg-5 col-sm-4">
                      <div className="stories-img">
                        <img
                          className="img-fluid"
                          src={item.img}
                          alt=""
                        />
                      </div>
                    </div>
                    <div className="col-lg-5 col-sm-4">
                      <div className="stories-content-details mx-auto">
                        <h3>{item.title}</h3>
                        <p>
                          {item.story}
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          )
        }) : <><StoryShim /><StoryShim /> </>
      }
      
    </>
  )
}

export default Storycontent