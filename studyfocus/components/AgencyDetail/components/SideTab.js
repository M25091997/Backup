import React, { useState } from 'react';
import { useDispatch, useSelector } from 'react-redux';
// import { getSingleTutor } from '../../../redux/actions';
import { generatePublicUrl } from '../../../helpers/urlConfig';
import StudentInfo from '../../StudentInfo';
import { Rating } from 'react-simple-star-rating';



export const SideTab = () => {
    // const [rating, setRating] = useState(0);
    // Catch Rating value
    // const handleRating = (rate) => {
    //     var user_id = localStorage.getItem('user_id');
    //     var tutor_id = localStorage.getItem('tutor_id');
    //     if (user_id == null) {
    //         alert('You need to Login First...');
    //         return false;
    //     } else {
    //         setRating(rate);
    //         const ratingData = {
    //             rating: rate, user_id: user_id, tutor_id: tutor_id
    //         }
    //         axios.post(`${api}/update/update-rating.php`, ratingData)
    //             .then(function (response) {
    //                 //handle success
    //                 alert(response.data.msg);
    //                 // console.log("success")
    //             })
    //             .catch(function (response) {
    //                 //handle error
    //                 console.log(response)
    //                 console.log("sorry")
    //             });
    //     }
    // }
    // const singleTutor = useSelector(state => state.singleTutorData);
    const singleAgency = useSelector(state => state.singleAgencyData);

    return (
        <>
            {
                singleAgency.singleagency.agency && singleAgency.singleagency.agency.length > 0 ? singleAgency.singleagency.agency.map(tutor =>
                    <>
                        <div className="card" style={{ width: "275px", height: "207px", marginTop: '20px', borderRadius: '20px' }}>

                            <div className="card-body">
                                <div className="row">
                                    <div className="col-md-12 col-xl-12">
                                        <center><img style={{ height: '57px', width: '63px', marginTop: '42px', borderRadius: '23px' }} src="/assets/tutor/view.png" alt="" /></center>
                                    </div>
                                    <div className="col-md-12 col-xl-12">
                                        <center><p className="tut_rating">98, Views</p></center>
                                    </div>
                                </div>


                            </div>

                        </div>

                        {/* </div> */}
                        <div className="card" style={{ width: "275px", height: "207px", marginTop: '20px', borderRadius: '20px' }}>

                            <div className="card-body">
                                <div className="row">
                                    <div className="col-md-12 col-xl-12">
                                        <center><img style={{ height: '57px', width: '63px', marginTop: '42px', borderRadius: '23px' }} src="/assets/tutor/rate.png" alt="" /></center>
                                    </div>
                                    <div className="col-md-12 col-xl-12">
                                        <center><p className="tut_rating">{singleAgency.singleagency.avg_rating} Rating</p></center>
                                    </div>
                                </div>


                            </div>

                        </div>

                        <div className="card" style={{ width: "275px", height: "207px", marginTop: '20px', borderRadius: '20px' }}>

                            <div className="card-body">
                                <div className="row">
                                    <div className="col-md-12 col-xl-12">
                                        <center><img style={{ height: '57px', width: '63px', marginTop: '42px', borderRadius: '23px' }} src="/assets/tutor/rupee.png" alt="" /></center>
                                    </div>
                                    <div className="col-md-12 col-xl-12">
                                        <center><p className="tut_fees">Tution Fees: <br /> ₹ {tutor.fee_range} / Mo</p></center>
                                    </div>
                                </div>


                            </div>

                        </div>


                    </>
                ) : ""
            }



        </>
    )
}
