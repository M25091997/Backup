import React from 'react'
import Head from 'next/head'
import ViewTutors from '../../../../components/ViewTutors'
import { useRouter } from 'next/router'


export default function viewTutors() {
    const router = useRouter()
    const { sub } = router.query;
    return (
        <>
            <Head>
                <title>StudyFocus: {sub}</title>
                <meta name="viewport" content="initial-scale=1.0, width=device-width" />
            </Head>
            <ViewTutors />
        </>
    )
}
