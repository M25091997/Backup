import React from 'react'
import Head from 'next/head'
import SignUp from '../components/Auth/SignUp/SignUp'


export default function contact() {
    return (
        <>
            <Head>
                <title>StudyFocus :: Register</title>
                <meta name="viewport" content="initial-scale=1.0, width=device-width" />
            </Head>
            <SignUp />
        </>
    )
}
