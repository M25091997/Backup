import React from 'react'
import Head from 'next/head'
import Enquiry from '../components/StudentEnquiry/Enquiry'

export const getStaticProps = async () => {
    const res = await fetch('https://cms.cybertizeweb.com/studyfocus/cybertechMedia/api/new-study-api/staticmeta/contact.php');
    const data = await res.json();

    return {
        props: { data }
    }
}

const contact = ({ data }) => {
    console.log(data);
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
            <Enquiry />
        </>
    )
}

export default contact;
