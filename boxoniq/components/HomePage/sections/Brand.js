import { useState, useEffect } from "react";
import axios from "axios";
import Link from "next/link";
import { Swiper, SwiperSlide } from "swiper/react";
import { Autoplay, Pagination, Navigation } from "swiper";

import "swiper/css";
import "swiper/css/pagination";

// Import Swiper styles
import "swiper/css";
import BrandShim from "./BrandShim";

const Brand = () => {
    const [brandData, setBrandData] = useState([]);

    const getBundle = async () => {
        try {
            const response = await axios({
                method: "GET",
                url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/brand-web-bo.php"
            });
            // console.log(response, 'hulu');
            setBrandData(response.data);
        } catch (err) {
            console.log(err);
        }
    };
    useEffect(() => {
        getBundle();
    }, []);

  return (
      <section className="brand-container">
          <h1 className="brand-title">BRANDS</h1>
          <div>
              <Swiper
                  spaceBetween={50}
                  slidesPerView={6}
                  breakpoints={{
                      "@0.00": {
                          slidesPerView: 2,
                          spaceBetween: 10,
                      },
                      "@1.00": {
                          slidesPerView: 3,
                          spaceBetween: 40,
                      },
                      "@1.50": {
                          slidesPerView: 4,
                          spaceBetween: 50,
                      },
                      "@2.00": {
                          slidesPerView: 6,
                          spaceBetween: 50,
                      },
                  }}
                  autoplay={{
                      delay: 2500,
                      disableOnInteraction: false,
                  }}
                  navigation={true}
                  modules={[Autoplay, Pagination, Navigation]}
              >
                  {brandData && brandData.length > 0 ? brandData.map((item) => {
                    return (
                        <SwiperSlide key={item.id}>
                            <div className="img-serve" style={{backgroundImage: `url(${item.brand})`}}>
                                   
                            </div>
                        </SwiperSlide>
                    )
                  }) : <div className="d-flex justify-content-between"><BrandShim /><BrandShim /><BrandShim /><BrandShim /><BrandShim /><BrandShim /><BrandShim /></div>}
                  
              </Swiper>
          </div>
      </section>
  )
}

export default Brand