import React from 'react'
import Head from 'next/head'
import { useRouter } from 'next/router'
import Detail from '../../components/AgencyDetail/Detail'


export default function blog() {

    const router = useRouter()
    const { agencysearch } = router.query;

    return (
        <>
            <Head>
                <title>StudyFocus: Blog-{agencysearch}</title>
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
            </Head>

            <Detail />

        </>
    )
}
