import React from 'react'
import Head from 'next/head'
import ViewAgencies from '../../../../components/ViewAgencies'
import { useRouter } from 'next/router'


export default function viewTutors() {
    const router = useRouter()
    const { subjects } = router.query;
    return (
        <>
            <Head>
                <title>StudyFocus: {subjects}</title>
                <meta name="viewport" content="initial-scale=1.0, width=device-width" />
            </Head>
            <ViewAgencies />
        </>
    )
}
