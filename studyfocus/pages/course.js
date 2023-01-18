import React from 'react'
import Head from 'next/head'
import Course from '../components/Course/Course'

export default function course() {
    return (
        <>
            <Head>
                <title>Course</title>
                <meta name="viewport" content="initial-scale=1.0, width=device-width" />
            </Head>
            <Course />
        </>
    )
}
