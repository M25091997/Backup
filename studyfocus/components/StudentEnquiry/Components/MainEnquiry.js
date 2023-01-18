import React, { useEffect, useState } from 'react'
import { useDispatch, useSelector } from 'react-redux';
import { getBlogData } from '../../../redux/actions';
import axios from 'axios';

import Shim from '../../Shim';
import EnquiryCard from '../../EnquiryCard';

const MainEnquiry = () => {
    const dispatch = useDispatch();
    const[blogsData, setBlogsData] = useState([]);
    
    async function getCity() {
       try{
        const response = await axios({
            method: 'GET',
            url: 'https://cybertizeweb.com/cms/studyfocus/cybertechMedia/api/new-study-api/blog/enquiry_fetchAll.php'
        });
        console.log(response.data.data, 'hulu');
        setBlogsData(response.data.data);
    }catch(error){
        console.log(error);
    }
    }
    useEffect(() => {
        getCity();
    }, []);

    return (
        <>
            <div className="row">
                {
                    blogsData.length > 0 ?
                        blogsData.slice(1,4).map(blog =>
                            <EnquiryCard blog={blog} />
                        ) : <>
                            <Shim height={'350px'} border={'4px'} grid={'col-xs-12 col-xl-6 col-lg-6 col-md-6'} />
                            <Shim height={'350px'} border={'4px'} grid={'col-xs-12 col-xl-6 col-lg-6 col-md-6'} />
                            <Shim height={'350px'} border={'4px'} grid={'col-xs-12 col-xl-6 col-lg-6 col-md-6'} />
                            <Shim height={'350px'} border={'4px'} grid={'col-xs-12 col-xl-6 col-lg-6 col-md-6'} />
                        </>
                }

            </div>
            
        </>
    )
}
export default MainEnquiry