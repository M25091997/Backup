import React from 'react'
import Head from 'next/head'
import { useRouter } from 'next/router'
import Detail from '../../components/Detail/Detail'

export const getServerSideProps = async (context) => {
    const slug = context.params.search;
    const res = await fetch(`https://cms.cybertizeweb.com/studyfocus/cybertechMedia/api/new-study-api/staticmeta/tutor_fetchSingle.php?tutor_slug=${slug}`);
    const data = await res.json();
    // console.log(data);

    return {
        props: { data }
    }
}


const tutDet = ({ data }) => {
    console.log(data);

    const router = useRouter()
    const { search } = router.query;

    return (
        <>
        <Head>
                <meta content={data.data.name} name="description" />
                <meta content={data.data.name} name="keywords" />
                <meta name="og:site_name" content={data.data.name} />
                <meta property="og:image" content={'https://studyfocus.in/assets/img/favicon.png'} />
                <meta name="og:description" content={data.data.name} />
                <meta property="og:title" content={data.data.name} />
                <meta property="og:type" content={data.data.name} /> 
                <title>StudyFocus | {data.data.name} </title>
            </Head>
            {/* <Head>
                <title>StudyFocus: Blog-{search}</title>
                <meta name="viewport" content="initial-scale=1.0, width=device-width" />
                <link rel="stylesheet" href="../../assets/css/preloader.css" />
                <link rel="stylesheet" href="../../assets/css/bootstrap.min.css" />
                <link rel="stylesheet" href="../../assets/css/meanmenu.css" />
                <link rel="stylesheet" href="../../assets/css/animate.min.css" />
                <link rel="stylesheet" href="../../assets/css/owl.carousel.min.css" />
                <link rel="stylesheet" href="../../assets/css/swiper-bundle.css" />
                <link rel="stylesheet" href="../../assets/css/backToTop.css" />
                <link rel="stylesheet" href="../../assets/css/jquery.fancybox.min.css" />
                <link rel="stylesheet" href="../../assets/css/fontAwesome5Pro.css" />
                <link rel="stylesheet" href="../../assets/css/elegantFont.css" />
                <link rel="stylesheet" href="../../assets/css/default.css" />
                <link rel="stylesheet" href="../../assets/css/style.css" />
            </Head> */}

            <Detail />

        </>
    )
}

export default tutDet;
