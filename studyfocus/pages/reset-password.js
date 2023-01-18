import React from 'react'
import Head from 'next/head'
import ResetPassword from '../components/Auth/ResetPassword'


export default function index() {
    return (
        <>
            <Head>
                <title>StudyFocus :: ResetPassword</title>
                <meta name="viewport" content="initial-scale=1.0, width=device-width" />
            </Head>
            <ResetPassword />
        </>
    )
}
