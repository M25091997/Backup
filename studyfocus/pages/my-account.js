import React from 'react'
import Head from 'next/head'
import MyAccount from '../components/MyAccount'


export default function contact() {
    return (
        <>
            <Head>
                <title>StudyFocus :: My Account</title>
                <meta name="viewport" content="initial-scale=1.0, width=device-width" />
            </Head>
            <MyAccount />
        </>
    )
}
