import React from 'react'
import Head from 'next/head'
// import Script from "next/script";
import HeroSection from '../components/Home/HeroSection'
import PopularCourses from '../components/Home/PopularCourses'
import BannerArea from '../components/Home/BannerArea'
import CourseArea from '../components/Home/CourseArea'
import EventsArea from '../components/Home/EventsArea'
import PricingArea from '../components/Home/PricingArea'
import BottomBannerArea from '../components/Home/BottomBannerArea'

export default function Home(users) {
  return (
    <>
      <Head>
        <title>Study Focus</title>
        <meta name="viewport" content="initial-scale=1.0, width=device-width" />
      </Head>
      <HeroSection />
      <PopularCourses />
      <BannerArea />
      <CourseArea />
      <EventsArea />
      <PricingArea />
      <BottomBannerArea />
      {console.log(users)}

      {/* <Script src="../assets/js/vendor/jquery-3.5.1.min.js"></Script>
      <Script src="../assets/js/vendor/waypoints.min.js"></Script>
      <Script src="../assets/js/bootstrap.bundle.min.js"></Script>
      <Script src="../assets/js/jquery.meanmenu.js"></Script>
      <Script src="../assets/js/swiper-bundle.min.js"></Script>
      <Script src="../assets/js/owl.carousel.min.js"></Script>
      <Script src="../assets/js/jquery.fancybox.min.js"></Script>
      <Script src="../assets/js/isotope.pkgd.min.js"></Script>
      <Script src="../assets/js/parallax.min.js"></Script>
      <Script src="../assets/js/backToTop.js"></Script>
      <Script src="../assets/js/jquery.counterup.min.js"></Script>
      <Script src="../assets/js/ajax-form.js"></Script>
      <Script src="../assets/js/wow.min.js"></Script>
      <Script src="../assets/js/imagesloaded.pkgd.min.js"></Script>
      <Script src="../assets/js/main.js"></Script> */}

    </>

  )
}

export const getStaticProps = async () => {
  const res = await fetch(`https://jsonplaceholder.typicode.com/users`)
  const users = await res.json()

  return {
    props: {
      users,
    },
  }
}