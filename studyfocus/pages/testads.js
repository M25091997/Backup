import React from 'react'
import Head from 'next/head'
import Testads from '../components/Test/Testads';



const ads = () => {
    return (
        <>
            <Head>
                <title>StudyFocus :: Test</title>
                <meta name="viewport" content="initial-scale=1.0, width=device-width" />
            </Head>
            <Testads/>
        </>
    )
}

export default ads;
