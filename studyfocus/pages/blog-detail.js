import React from 'react'
import Head from 'next/head'
import BlogDetail from '../components/BlogDetail/BlogDetail'

export default function blog() {
    return (
        <>
            <Head>
                <title>Blog</title>
                <meta name="viewport" content="initial-scale=1.0, width=device-width" />
            </Head>
            <BlogDetail />
        </>
    )
}
