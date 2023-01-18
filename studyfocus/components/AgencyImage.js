import React from 'react'

const AgencyImage = (p) => {

    const sty = {
        height: p.height,
        width: p.width,
        backgroundImage: "url(" + p.image + ")",
        backgroundRepeat: 'no - repeat',
        objectFit: 'cover',
        backgroundSize: p.size
    }

    return (
        <div 
        // className="agency_image" 
            style={{ height: p.height, width: p.width,
                backgroundImage: "url(" + p.image + ")",
                backgroundRepeat: 'no - repeat',
                objectFit: 'cover',
                backgroundSize: p.size
             }}></div>
    )
}

export default AgencyImage;
