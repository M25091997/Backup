import React from 'react';
import TopNav from './components/TopNav/TopNav';
import Footer from './components/Footer/Footer';
import Head from 'next/head';


const Layout = ({ children }) => {
    return (
        <>
            <Head>
                <title>Study Focus</title>
                <meta name="viewport" content="initial-scale=1.0, width=device-width" />
            </Head>
            <TopNav />
            {children}
            <Footer />
        </>
    )
}

export default Layout;