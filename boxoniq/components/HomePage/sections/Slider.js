import { useState, useEffect } from "react";
import { Swiper, SwiperSlide } from "swiper/react";
import { Autoplay, Pagination, Navigation } from "swiper";
import "swiper/css";
import "swiper/css/pagination";
import "swiper/css/navigation";
import Link from "next/link";
import axios from "axios";



const Slider = () => {
    const [sliderData, setSliderData] = useState([]);

    const getBundle = async () => {
        try {
            const response = await axios({
                method: "GET",
                url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/slider-bo.php"
            });
            // console.log(response, 'hulu');
            setSliderData(response.data);
        } catch (err) {
            console.log(err);
        }
    };
    useEffect(() => {
        getBundle();
    }, []);
  return (
      <section className="swiper_carousel" style={{paddingTop: "15px"}}>
          <Swiper
              spaceBetween={30}
              centeredSlides={true}
              autoplay={{
                  delay: 3000,
                  disableOnInteraction: false,
              }}
              modules={[Autoplay, Pagination, Navigation]}
              className="mySwiper"
          >
              {sliderData && sliderData.length > 0 ? sliderData.map((item) => {
                return (
                    <SwiperSlide key={item.slider_id} className="position-relative">
                        <img
                            style={{width:'100%', height:'500px'}}
                            className=""
                            src={item.slide}
                            alt=""
                        />
                        {/* <div className="carusel-text ">
                            <h1>Start</h1>
                            <h2>your</h2>
                            <h2>Bundle</h2>
                            <h2 className="carusel-button me-2">Now</h2>
                            <img
                                className=" d-sm-none d-inline"
                                src="https://i.ibb.co/KK7r5mF/Vector-2.png"
                                alt=""
                            />
                            <img
                                className="d-none d-sm-block"
                                src="https://i.ibb.co/HrXYz5D/Arrow-2.png"
                                alt=""
                            />
                        </div> */}
                    </SwiperSlide>
                )
              }) : ""}
          </Swiper>
      </section>
  )
}

export default Slider