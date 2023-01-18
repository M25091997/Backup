import React, { useEffect, useState } from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { getSingleBlog } from '../../../redux/actions';
import { useRouter } from 'next/router';
import Comments from './Comments';
import RelatedPosts from './RelatedPosts';
import Review from './Review';
const ReactDOMServer = require('react-dom/server');
const HtmlToReactParser = require('html-to-react').Parser;

const MainBlogDetail = () => {
    const router = useRouter()
    const { bid } = router.query;
    const dispatch = useDispatch();
    const singleBlog = useSelector(state => state.singleBlogData);


    useEffect(() => {
        if (bid != undefined) {
            const bslug = {
                blog_slug: `${bid}`,
            }
            console.log(bslug);
            try {
                dispatch(getSingleBlog(bslug));
            } catch (e) {
                console.log(e);
            }
        }
    }, [bid]);

    const renderHtml = (parseData) => {
        const htmlInput = '';
        const htmlToReactParser = new HtmlToReactParser();
        const reactElement = htmlToReactParser.parse(parseData);
        return reactElement;
    }

    return (
        <div className="blog__wrapper">
            <div className="blog__text mb-40">
                {
                    singleBlog.singleblog.length > 0 ? singleBlog.singleblog.map(single =>
                        <p>{
                            renderHtml(single.blog_detail)
                        }</p>
                    ) : ""
                }
                {/* <p>Me old mucker argy-bargy  I'm telling pear shaped Jeffrey super brilliant, I excuse my French blatant gormless up the duff, cup of char up the kyver tosser cras happy days. The full monty he nicked it he legged it bum bag burke plastered arse over tit it's your round owt to do with me pardon you, on your bike mate hanky panky mush cuppa only a quid crikey Jeffrey skive off, faff about so I said what a load of rubbish blag David knees up cockup cras. Argy-bargy give us a bell wellies gosh skive off old bodge cheesed off A bit of how's your father off his nut bamboozled, bugger say I'm telling morish bleeding boot up the kyver nice one brilliant, ruddy jolly good fanny around chinwag amongst brown bread arse brolly. Horse play it's all gone to pot codswallop easy peasy mush knees up down the pub jolly good nice one tosser it's your round lurgy, I vagabond barmy off his nut only a quid so I said is gosh Charles blow off, pardon me chip shop Richard spiffing skive off bleeding get stuffed mate porkies amongst the full monty.</p> */}
            </div>


            <div className="blog__line"></div>
            <div className="blog__meta-3 d-sm-flex justify-content-between align-items-center mb-80">
                {/* <div className="blog__tag-2">
                    <a href="#">Art & Design</a>
                    <a href="#">Education</a>
                    <a href="#">App</a>
                </div> */}
                <div className="blog__social d-flex align-items-center">
                    <h4>Share:</h4>
                    <ul>
                        <li><a href="#" className="fb" ><i className="social_facebook"></i></a></li>
                        <li><a href="#" className="tw" ><i className="social_twitter"></i></a></li>
                        <li><a href="#" className="pin" ><i className="social_pinterest"></i></a></li>
                    </ul>
                </div>
            </div>
            {/* <div className="blog__author-3 d-sm-flex grey-bg mb-90">
                <div className="blog__author-thumb-3 mr-20">
                    <img src="/assets/img/blog/author/blog-author-1.jpg" alt="" />
                </div>
                <div className="blog__author-content">
                    <h4>Justin Case</h4>
                    <span>Author</span>
                    <p>So I said blower wellies a blinding shot jolly good argy-bargy he nicked it, in my flat don't get shirty with me tosser.</p>
                </div>
            </div> */}
            <RelatedPosts />
            {/* <Comments /> */}
            {/* <Review /> */}
        </div>
    )
}



export default MainBlogDetail
