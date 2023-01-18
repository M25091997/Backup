import React from 'react'
import Head from 'next/head'
import Qualification from '../../components/MyAccount/qualification'
import { useRouter } from 'next/router'



const Qual = () => {
    const router = useRouter();
    const { quaId } = router.query;
    return (
        <>
            <Head>
                <title>StudyFocus :: Edit Qualification</title>
                <meta name="viewport" content="initial-scale=1.0, width=device-width" />
            </Head>
            <Qualification />
        </>
    )
}
export default Qual;
