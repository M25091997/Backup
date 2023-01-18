import React from 'react'
import Head from 'next/head'
import ViewTutors from '../../components/ViewTutors'

export default function viewTutors() {
    return (
        <>
            <Head>
                <title>StudyFocus: View Tutors</title>
                <meta name="viewport" content="initial-scale=1.0, width=device-width" />
            </Head>
            <ViewTutors />
        </>
    )
}
