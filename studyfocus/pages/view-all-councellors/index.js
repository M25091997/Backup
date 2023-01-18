import React from 'react'
import Head from 'next/head'
import ViewCouncellors from '../../components/ViewCouncellors'

export default function viewCouncellors() {
    return (
        <>
            <Head>
                <title>StudyFocus: ViewCouncellors</title>
                <meta name="viewport" content="initial-scale=1.0, width=device-width" />
            </Head>
            <ViewCouncellors />
        </>
    )
}
