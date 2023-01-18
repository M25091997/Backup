import { useState, useEffect } from "react";
import axios from "axios";
import Router from "next/router";
import CategoryShim from "./CategoryShim";

const Shop = () => {
    const [categoryData, setCategoryData] = useState([]);

    const goToBundle = (iteseq) => {
        Router.push('/bundleCreator/'+iteseq);
    }

    const getCategory = async () => {
        try {
            const response = await axios({
                method: "GET",
                url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/super-cat-bo.php"
            });
            // console.log(response, 'hulu');
            setCategoryData(response.data);
        } catch (err) {
            console.log(err);
        }
    };
    useEffect(() => {
        getCategory();
    }, []);

  return (
      <section className="shop-container">
          <div className="shop-content">
              <h2 className="title">SHOP BY CATEGORY</h2>
              <p className="short-title">
                  Skip modify your bundle as per requirement
              </p>
              <div className="shop-block-container">
                  <div className="row justify-content-between align-items-center">
                      {categoryData && categoryData.length > 0 ? categoryData.map((item) => {
                        return (
                            <div style={{cursor:"pointer"}} key={item.id} className="col-6 col-sm-4 col-lg-2">
                               <center>
                                 <img
                                    className="w-75"
                                    src={item.image}
                                    alt=""
                                    onClick={() => goToBundle(item.sequence)}
                                />
                                <h6 style={{fontWeight:'bolder'}} className="text-center my-4">{item.name.slice(0,13)}</h6>
                               </center>
                            </div>
                        )
                      }) : 
                      <>
                              <CategoryShim />
                              <CategoryShim />
                              <CategoryShim />
                              <CategoryShim />
                              <CategoryShim />
                              <CategoryShim />
                      </>
                      
                      }
                      
                  </div>
              </div>
          </div>
      </section>
  )
}

export default Shop