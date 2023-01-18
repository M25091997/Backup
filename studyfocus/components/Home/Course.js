import React from 'react';
// import Image from 'next/image'
import { useSelector } from 'react-redux';
// import { generatePublicUrl } from '../../helpers/urlConfig';
// import Link from 'next/link'
import Shim from '../Shim';
import Card from '../Card';
import { base_url } from '../../helpers/urlConfig';




 const Course = () => {
    // const searchTutorAgency = useSelector(state => state.searchTutorAgency);
    const initialData = useSelector(state => state.initialData);
    // const genLinkUrl = (slug) => {
    //     return `tutor-detail/${slug}`;
    // }
    // const renderNew = () => {
    //     return <span className="badge bg-primary text-center" style={{ fontSize: '10px' }}>Fresher</span>
    // }
    // const renderExp = (exp) => {
    //     // return `<span className="e-btn e-btn-2">${exp} years Experience</span>`;
    //     return <span className="badge bg-primary"> $(exp) years Experience</span>

    // }
    return (
        <div className="row grid">
            {
                initialData.loading ? <>
                    <Shim height={'350px'} border={'4px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3'} />
                    <Shim height={'350px'} border={'4px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3'} />
                    <Shim height={'350px'} border={'4px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3'} />
                    <Shim height={'350px'} border={'4px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3'} />
                </> :
                    initialData.tutors && initialData.tutors.length > 0 ?
                    initialData.tutors.map(tutor =>
                        <Card x={tutor} />
                        ) : <center><img width={'50%'} src={base_url + "/assets/img/logo/notfound.jpg"} alt="logo" /></center>
                    
            }

        </div>
    )
}

export default Course;