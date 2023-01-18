import React from 'react'
import Head from 'next/head'
import Search from '../../components/Search'

export default function search() {
    return (
        <>
            <Head>
                <title>Course</title>
                <meta name="viewport" content="initial-scale=1.0, width=device-width" />
            </Head>
            <Search />
        </>
    )
}
