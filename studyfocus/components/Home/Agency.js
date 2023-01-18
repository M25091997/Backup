import React from 'react';
import { useSelector } from 'react-redux';
import { generatePublicUrl } from '../../helpers/urlConfig';
import Link from 'next/link'
import Shim from '../Shim';
import Card from '../Card';
import { base_url } from '../../helpers/urlConfig';


export default function Agency() {
    const initialData = useSelector(state => state.initialData);
    const genLinkUrl = (slug) => {
        return `agency-detail/${slug}`;
    }
    return (
        <div className="row grid">
            {
                initialData.loading ? <>

                    <Shim height={'350px'} border={'4px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3'} />
                    <Shim height={'350px'} border={'4px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3'} />
                    <Shim height={'350px'} border={'4px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3'} />
                    <Shim height={'350px'} border={'4px'} grid={'col-xs-12 col-xl-3 col-lg-3 col-md-3'} />

                </> :
                    initialData.agency && initialData.agency.length > 0 ?
                    initialData.agency.map(agenc =>
                        <Card x={agenc} type={"agency"} />
                        ) : <center><img width={'30%'} src={base_url + "/assets/img/logo/not.png"} alt="logo" /></center>
                    
            }

        </div>
    )
}