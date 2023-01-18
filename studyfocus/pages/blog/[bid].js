import React from 'react'
import Head from 'next/head'
// import { useRouter } from 'next/router'
import BlogDetail from '../../components/BlogDetail/BlogDetail';

export const getServerSideProps = async (context) => {
    const slug = context.params.bid;
    const res = await fetch(`https://cms.cybertizeweb.com/studyfocus/cybertechMedia/api/new-study-api/staticmeta/blog_fetchSingle.php?blog_slug=${slug}`);
    const data = await res.json();
    // console.log(data);

    return {
        props: { data }
    }
}

const blog = ({ data }) => {
    console.log(data);
    console.log(data.data.blog_title);
    // const router = useRouter();
    // const { bid } = router.query;

    return (
        <>
            <Head>
                <meta content={data.data.blog_title} name="description" />
                <meta content={data.data.blog_title} name="keywords" />
                <meta name="og:site_name" content={data.data.blog_title} />
                <meta property="og:image" content={'https://cybertizeweb.com/cms/studyfocus/img/newblog/' + data.data.blog_photo} />
                <meta name="og:description" content={data.data.blog_title} />
                <meta property="og:title" content={data.data.blog_title} />
                <meta property="og:type" content={data.data.blog_title} /> 
                <title>StudyFocus | {data.data.blog_title} </title>
            </Head>
            {/* <Head>
                <title>StudyFocus: Blog-{bid}</title>
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

            <BlogDetail />

        </>
    )
}

export default blog;
