import { useState, useEffect } from "react";
import axios from "axios";
import Router from 'next/router'
import BlogsShim from "./BlogsShim";



const Blogscontent = () => {
    const [blogData, setBlogData] = useState([]);

    const goToblog = (blogId) => {
        Router.push("blogs/" + blogId);

    }

    const categoryName = () => {
        axios
            .get(
                "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/get-blogs-bo.php"
            )
            .then((response) => {
                console.log(response.data,'lulu');
                setBlogData(response.data);
            })
            .catch((err) => {
                console.log(err);
            });
    };
    useEffect(() => {
        categoryName();
    }, []);
  return (
    <>
          {
              blogData && blogData.length > 0 ? blogData.map((item) => {
                return (
                    <div onClick={() => goToblog(item.slug)} key={item.id} className="col-lg-4 col-md-2 col-12 law-wrapper" style={{ cursor: 'pointer' }}>
                        <div className="card" style={{ border: "0 !important" }}>
                            <img className="card-img-top img-responsive" style={{ borderRadius: '3px', height:'250px', width:'100%' }} src={item.img} alt="CLAT PG(LLM) 2021 Details" />
                                <div className="card-body">
                                    <h3 className="card-title xnew-title" style={{ fontSize: '18px', textAlign: 'left' }}>{item.title}</h3>
                                    <p className="card-text" style={{ color: '#4e4e4e', textAlign: 'left' }}>{item.blog_desc.slice(0,200)}
                                    </p>

                                </div>
                        </div>
                    </div>
                )
              }) : <div className="d-flex"><BlogsShim /><BlogsShim /><BlogsShim /></div>
          }
          
    </>
  )
}

export default Blogscontent