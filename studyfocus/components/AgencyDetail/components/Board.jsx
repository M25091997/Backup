import React from 'react'

export default function Board(props) {
    const tutor = props.x;
    const renderSubArray = (sub) => {
        const myArray = sub.split(",");
        return myArray;
    }
    return (
        <section className="events__area p-relative" style={{paddingTop: '10px'}}>
            {/* <div className="events__shape">
                <img className="events-1-shape" src="assets/img/events/events-shape.png" alt="" />
            </div> */}
            <div className="container">
                {/* <div className="row">
                    <div className="col-xxl-4 offset-xxl-4">
                        <div className="section__title-wrapper mb-60 text-center">
                            <h2 className="section__title">Current <span className="yellow-bg yellow-bg-big">Events<img
                                src="assets/img/shape/yellow-bg.png" alt="" /></span></h2>
                            <p>We found 13 events available for you.</p>
                        </div>
                    </div>
                </div> */}
                <div className="row">
                    <div className="col-xxl-10 offset-xxl-1 col-xl-10 col-lg-10" style={{width:"100%"}}>
                        <div className="events__item mb-10 hover__active">
                            <div className="events__item-inner d-sm-flex align-items-center justify-content-between white-bg">
                                <div className="events__content">
                                    <div className="events__meta">
                                        <span className="board_detail">Class</span>
                                        {/* <span>12:00 am - 2:30 pm</span>
                                        <span>New York</span> */}
                                    </div>
                                    <h3 className="events__title">
                                        <a href="event-details.html">
                                            {
                                                    tutor.class && tutor.class.length > 0 ?
                                                        renderSubArray(tutor.class).slice(0, 2).map(i =>
                                                            <span className="badge bg-warning text-center sub_badge">{i.substring(0, 10) + '...'}</span>
                                                        ) : null
                                            }
                                        </a>
                                    </h3>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div className="col-xxl-10 offset-xxl-1 col-xl-10 col-lg-10" style={{width:"100%"}}>
                        <div className="events__item mb-10 hover__active active">
                            <div className="events__item-inner d-sm-flex align-items-center justify-content-between white-bg">
                                <div className="events__content">
                                    <div className="events__meta">
                                        <span className="board_detail">Board</span>
                                        {/* <span>9:00 am - 5:00 pm</span>
                                        <span>Mindahan</span> */}
                                    </div>
                                    <h3 className="events__title"><a href="event-details.html">
                                        {/* {tutor.board} */}
                                        Board
                                        </a>
                                    </h3>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div className="col-xxl-10 offset-xxl-1 col-xl-10 col-lg-10" style={{width:"100%"}}>
                        <div className="events__item mb-10 hover__active">
                            <div className="events__item-inner d-sm-flex align-items-center justify-content-between white-bg">
                                <div className="events__content">
                                    <div className="events__meta">
                                        <span className="board_detail">Medium</span>
                                        {/* <span>10:30 am - 1:30 pm</span>
                                        <span>Weedpatch</span> */}
                                    </div>
                                    <h3 className="events__title"><a href="event-details.html">
                                        {/* {tutor.medium} */}
                                        Medium
                                        </a></h3>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
    )
}
