import React from 'react'
import Head from 'next/head'
import ViewAgencies from '../../components/ViewAgencies'

export default function viewAgencies() {
    return (
        <>
            <Head>
                <title>StudyFocus: ViewAgencies</title>
                <meta name="viewport" content="initial-scale=1.0, width=device-width" />
            </Head>
            <ViewAgencies />
        </>
    )
}
