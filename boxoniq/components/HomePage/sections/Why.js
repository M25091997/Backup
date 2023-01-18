import { useState, useEffect } from "react";
import axios from "axios";
import { Swiper, SwiperSlide } from "swiper/react";
import { Autoplay, Pagination, Navigation } from "swiper";

import "swiper/css";
import "swiper/css/pagination";

// Import Swiper styles
import "swiper/css";
import WhyShim from "./WhyShim";

const Why = () => {
    const [whyData, setWhyData] = useState([]);

    const getBundle = async () => {
        try {
            const response = await axios({
                method: "GET",
                url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/get-home-why-choose-section-bo.php"
            });
            // console.log(response, 'hulu');
            setWhyData(response.data);
        } catch (err) {
            console.log(err);
        }
    };
    useEffect(() => {
        getBundle();
    }, []);
  return (
      <section className="why-chose-container">
          <h1 className="chose-title">WHY CHOOSE BOXONIQ?</h1>
          <Swiper
              spaceBetween={50}
              slidesPerView={4}
              breakpoints={{
                  "@0.00": {
                      slidesPerView: 2,
                      spaceBetween: 10,
                  },
                  "@1.50": {
                      slidesPerView: 3,
                      spaceBetween: 40,
                  },
                  "@2.00": {
                      slidesPerView: 4,
                      spaceBetween: 50,
                  },
              }}
              autoplay={{
                  delay: 2500,
                  disableOnInteraction: false,
              }}
              navigation={true}
              modules={[Autoplay, Pagination, Navigation]}
              onSlideChange={() => console.log("slide change")}
              onSwiper={(swiper) => console.log(swiper)}
          >
              {whyData && whyData.length > 0 ? whyData.map((item) => {
                return (
                    <SwiperSlide key={item.id}>
                        <div className="container-img">
                            <img
                                className="w-100"
                                src={item.image}
                                alt=""
                            />
                            <p className="chose-para">
                                {item.desc.slice(0,50)}
                            </p>
                        </div>
                    </SwiperSlide>
                )
              }) : <div className="d-flex justify-content-between"><WhyShim /><WhyShim /><WhyShim /><WhyShim /></div>}
              
          </Swiper>
      </section>
  )
}

export default Why