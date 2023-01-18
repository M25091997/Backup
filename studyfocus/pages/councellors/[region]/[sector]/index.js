import React from 'react'
import Head from 'next/head'
import ViewCouncellors from '../../../../components/ViewCouncellors'
import { useRouter } from 'next/router'


export default function viewTutors() {
    const router = useRouter()
    const { sector } = router.query;
    return (
        <>
            <Head>
                <title>StudyFocus: {sector}</title>
                <meta name="viewport" content="initial-scale=1.0, width=device-width" />
            </Head>
            <ViewCouncellors />
        </>
    )
}
