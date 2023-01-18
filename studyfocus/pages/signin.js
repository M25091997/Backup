import React from 'react'
import Head from 'next/head'
import Login from '../components/Auth/Login/Login'


export default function contact() {
    return (
        <>
            <Head>
                <title>StudyFocus :: Login</title>
                <meta name="viewport" content="initial-scale=1.0, width=device-width" />
            </Head>
            <Login />
        </>
    )
}
