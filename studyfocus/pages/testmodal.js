import React from 'react'
import Head from 'next/head'
import TestModal from '../components/Test/TestModal'



export default function contact() {
    return (
        <>
            <Head>
                <title>StudyFocus :: Test</title>
                <meta name="viewport" content="initial-scale=1.0, width=device-width" />
            </Head>
            <TestModal />
        </>
    )
}
