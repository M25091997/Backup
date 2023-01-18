import React from 'react'
import Head from 'next/head'
// import { useRouter } from 'next/router'



export default function blog({ city, subject, res }) {

    // const router = useRouter()
    // const { city, subject } = router.query;

    return (
        <>
            <Head>
                <title>{city}-{subject}-{res}</title>
            </Head>
        </>
    )
}

export async function getServerSideProps(context) {
    const { params } = context;
    const { city, subject } = params;

    const res = await fetch("https://studyfocus.in/cybertechMedia/api/new-study-api/testssr.php");
    const apires = await res.json();

    return {
        props: {
            city: city,
            subject: subject,
            res: apires
        }
    }
}
