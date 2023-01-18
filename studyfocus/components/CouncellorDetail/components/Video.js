import React from 'react'

export const Video = () => {
    return (
        <>
            <div className="course__video-thumb w-img mb-25">
                <img src="/assets/img/course/video/course-video.jpg" alt="" />
                <div className="course__video-play">
                    <a href="https://youtu.be/yJg-Y5byMMw" data-fancybox="" className="play-btn"> <i className="fas fa-play"></i> </a>
                </div>
            </div>
        </>
    )
}
