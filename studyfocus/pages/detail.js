import React from 'react'
import Head from 'next/head'
import Detail from '../components/Detail/Detail'

export default function detail() {
    return (
        <>
            <Head>
                <title>StudyFocus: Detail</title>
                <meta name="viewport" content="initial-scale=1.0, width=device-width" />
            </Head>
            <Detail />
        </>
    )
}
