import React, { useState } from "react";
import { Swiper, SwiperSlide } from "swiper/react";
import { Autoplay, Pagination, Navigation } from "swiper";

import "swiper/css";
import "swiper/css/pagination";

// Import Swiper styles
import "swiper/css";
import Shop from "./sections/Shop";
import Contact from "./sections/Contact";
import Why from "./sections/Why";
import Brand from "./sections/Brand";
import Bundle from "./sections/Bundle";
import Box from "./sections/Box";
import Slider from "./sections/Slider";

const HomePage = () => {
  return (
    <div style={{ backgroundColor: "#E5E5E5" }}>
      {/* Carusel section start */}
      <Slider/>
    <div className="container">
      {/* Box area start */}
      <Box/>
      <br/>

      {/* Bundle banifite area start     */}
      <Bundle/>

      {/* Shop section */}
      <Shop/>

      {/* Brand section start here */}
      <Brand/>

      {/* Why chose us */}
      <Why/>

      {/*Contact section */}
      <Contact/>
      </div>

    </div>
  );
};

export default HomePage;
