import React from 'react'
// import Image, { Shimmer } from 'react-shimmer'
// import { ShimmerCircularImage } from "react-shimmer-effects";
// import { ShimmerFeaturedGallery } from "react-shimmer-effects";
import { ShimmerPostList } from "react-shimmer-effects";

const ShimmerTest = () => {
    return (
        <div>
            <h1>Hi Nik</h1>
            <h1>Hi Nik</h1>
            <h1>Hi Nik</h1>
            <h1>Hi Nik</h1>
            <h1>Hi Nik</h1>
            {/* <ShimmerCircularImage size={150} /> */}
            {/* <ShimmerFeaturedGallery row={2} col={2} card frameHeight={600} /> */}
            <ShimmerPostList postStyle="STYLE_FOUR" col={4} row={2} gap={30} />

        </div>
    )
}

export default ShimmerTest;
