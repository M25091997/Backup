import React from 'react'
import Link from 'next/link';
import { generatePublicUrl } from '../helpers/urlConfig';
import AgencyImage from './AgencyImage';
import Image from './Image';
import { base_url } from '../helpers/urlConfig';


const Cardads = (props) => {
    const tutor = props.x;

    return (
        <>
            <div className="col-xxl-3 col-xl-3 col-lg-3 col-md-4 grid-item cat1 cat2 cat4">
            <div className="course__item white-bg mb-30 fix" style={{border:'1px solid #3a4eff'}}>
            <div style={{backgroundColor: '#000',backgroundSize:'contain',height: '166px',backgroundImage: "url(" + tutor.profile + ")"}}></div>
                <div className="course__content">
                    <div className="course__teacher align-items-center">
                        <h6>{tutor.name}</h6>
                <p>{(tutor.description.length < 124) ? tutor.description : tutor.description.substring(0, 124) + '...'}</p>
                    </div>
                </div>
                <div className="course__more d-flex justify-content-between align-items-center">
                    <div className="course__status">
                    <span class="badge bg-warning text-center" 
                    style={{fontSize: '10px', color : '#000', marginRight: '3px', backgroundColor: 'rgb(71, 98, 167)'}}>Ads</span>
                    </div>
                    <div className="course__btn">
                        <a target="_blank" href={tutor.link}>
                            <span className="btn btn-primary" style={{ fontSize: '10px',color: '#3a4eff',borderColor: '#0d6efd', backgroundColor:'#fff' }}>Visit Website <i className="far fa-arrow-right"></i></span>
                        </a>

                    </div>
                </div>
            </div>
        </div>
        </>
    )
}

export default Cardads;
