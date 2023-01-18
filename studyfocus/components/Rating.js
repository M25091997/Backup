import React, { useState, useEffect } from 'react';
import { Rating } from 'react-simple-star-rating';

const Rate = () => {
    const [rating, setRating] = useState(0);
    // Catch Rating value
    const handleRating = (rate) => {
        alert(rate);
        setRating(rate);
        // Some logic
    }

    return (
        <>
            <section className="signup__area po-rel-z1 pt-100 pb-145">
                <div className="container">
                    <div className="row">
                        <div className="col-xxl-6 offset-xxl-3 col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                            <div className="sign__wrapper white-bg">

                                <div className="sign__form">
                                    <Rating onClick={handleRating} ratingValue={rating} />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </>
    )
}

export default Rate;