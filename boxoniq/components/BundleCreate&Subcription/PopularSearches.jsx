import React, { useEffect, useState } from "react";
import Navbar from "../Navbar";
const PopularSearches = () => {
  const [products, setProducts] = useState([]);
  useEffect(() => {
    fetch("products.json")
      .then((res) => res.json())
      .then((data) => setProducts(data));
  });
  return (
    <div className="div">
      <Navbar />

      <div className="">
        <div className="row p-4">
          <h1 className="popular-searches text-center pb-3">
            Popular Searches
          </h1>
          {products.map((product) => (
            <div key={product.id} className="col-lg-4 ">
              <div className="bundle_item">
                <div>
                  <div className="thum">
                    <img
                      src="https://i.ibb.co/p2vVfBK/hello-bello-vitamins-MENS-front-580x-1.png"
                      alt=""
                    />
                  </div>
                </div>
                <div className="bundle_text">
                  <h3>Organic Men&apos;s Multi</h3>
                  <p>
                    Contains 14 essential vitamins and minerals. Vegan, USDA
                    certified organic, and nonGMO.
                  </p>
                  <div className="bundle_footer_btn">
                    <div className="remove_btn add_to_bundle_btn">
                      <button href="/">Add to Bundle</button>
                    </div>
                    <div className="select_price">
                      <button>
                        ₹500 / 1Kg
                        <img
                          src="https://i.ibb.co/4TKrXKD/Vector-4.png"
                          alt=""
                        />
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          ))}
        </div>
      </div>
    </div>
  );
};

export default PopularSearches;
