import { useState, useEffect } from "react";
import axios from "axios";
import Router from 'next/router'

import Storycontent from "./sections/Storycontent";

const Stories = () => {
  const [storyData, setStoryData] = useState([]);
  const [search, setSearch] = useState('');
  const [title, setTitle] = useState('Stories');


  const searchProduct = async(search_key) => {
    console.log(search_key.length, 'huu');
    if(search_key.length>2){
      const send_data = {
        "search" : search_key
      }
      // console.log(search_key,'hulu');
      // return false;
      try {
        const response = await axios({
          method: "POST",
          url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/get-stories-search-web-bo.php",
          data: send_data
      });
      setStoryData(response.data);
      setTitle('Search Stories');

      // console.log(response, 'hulu');
      // if(response.data.response == 1){
      //     alert(response.data.msg);
      // }
      } catch (e) {
        console.log(e);
      }
    }else{
      getStory();
      setTitle('Stories');
    }
  }

  const goToStory = (storyId) => {
    Router.push("stories/" + storyId);
  }

  const getStory = () => {
    axios
      .get(
        "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/get-stories.php"
      )
      .then((response) => {
        setStoryData(response.data);
      })
      .catch((err) => {
        console.log(err);
      });
  };
  useEffect(() => {
    getStory();
  }, []);
  return (
    <div>
      <section className="stories position-relative">
        <div className="stories-bg"></div>
        <div className="stories-container container-fluid">
          
              <div className="row">
                <div className="col-lg-12">
                  <div className="stories-content text-center">
                    <h1>{title}</h1>
                    <p className="text-center mx-auto">
                      Lorem Ipsum is simply dummy text of the printing and
                      typesetting industry.
                    </p>
                    <form>
                      <input
                        type="email"
                        className="form-control search-control mx-auto text-center mb-3"
                        id="exampleFormControlInput1"
                        placeholder="Search for answers, topics..."
                        value={search}
                        onChange={(e) => { setSearch(e.target.value); searchProduct(search);}}
                      />
                      <img
                        className="story-img"
                        src="https://i.ibb.co/ZLyZqB4/search-6-1.png"
                        alt=""
                      />
                    </form>
                  </div>
                </div>
              </div>
              <Storycontent x={storyData}/>
            
        </div>
      </section>
    </div>
  );
};

export default Stories;
