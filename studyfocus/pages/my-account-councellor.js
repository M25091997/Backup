import React from 'react'
import Head from 'next/head'
import Councellor from '../components/MyAccount/Councellor'


export default function contact() {
    return (
        <>
            <Head>
                <title>StudyFocus :: My Account Councellor</title>
                <meta name="viewport" content="initial-scale=1.0, width=device-width" />
            </Head>
            <Councellor />
        </>
    )
}
