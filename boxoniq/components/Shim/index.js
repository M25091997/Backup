import React from 'react'

const Shim = (p) => {
    const style = {
        height: p.height,
        width: p.width,
        marginLeft: p.left,
        marginTop: p.top,
        border: p.border + " solid #E5E5E5",
        borderRadius: p.radius
    }


    const cl = p.grid + "grid-item cat1 cat2 cat4 animated-background";

    return (
        <>
            <div style={style} className={cl}></div>
        </>
    )
}

export default Shim;
