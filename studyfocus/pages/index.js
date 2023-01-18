import React from 'react'
import Head from 'next/head'
import HeroSection from '../components/Home/HeroSection'
import PopularCourses from '../components/Home/PopularCourses'
import BannerArea from '../components/Home/BannerArea'
import CourseArea from '../components/Home/CourseArea'
import EventsArea from '../components/Home/EventsArea'
import PricingArea from '../components/Home/PricingArea'
import BottomBannerArea from '../components/Home/BottomBannerArea'
import AgencyArea from '../components/Home/AgencyArea'
import CouncellorArea from '../components/Home/CouncellorArea'

export const getStaticProps = async () => {
    const res = await fetch('https://cms.cybertizeweb.com/studyfocus/cybertechMedia/api/new-study-api/staticmeta/home.php');
    const data = await res.json();

    return {
        props: { data }
    }
}
const Home = ({ data }) => {
    return (
        <>
            <Head>
                <title>{data.title} </title>
                <meta content={data.description} name="description" />
                <meta content={data.key} name="keywords" />
                <meta name="og:site_name" content={data.ogsitename} />
                <meta property="og:image" content={data.ogimage} />
                <meta name="og:description" content={data.ogdescription} />
                <meta property="og:title" content={data.ogtitle} />
                <meta property="og:type" content={data.ogtype} />
                <meta name="viewport" content="initial-scale=1.0, width=device-width" />
            </Head>

            {/* {users.map(user => (
                <div>{user.name}</div>
            ))} */}

            <HeroSection />
            <PopularCourses />
            <BannerArea />
            <CourseArea />
            <AgencyArea />
            <CouncellorArea />
            <EventsArea />
            <PricingArea />
            <BottomBannerArea />
        </>

    )
}

export default Home;

