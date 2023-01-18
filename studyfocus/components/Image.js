import React from 'react'

const Image = (props) => {
    return (
        <div>
            <img width={props.width}
                src={props.src} alt={props.alt} />
        </div>
    )
}

export default Image;
