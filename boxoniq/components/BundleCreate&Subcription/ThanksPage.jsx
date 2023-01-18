import { useState, useEffect } from "react";
import axios from "axios";
import Router from 'next/router';

const ThanksPage = () => {
    const [orderId, setOrderId] = useState('');

    const getBundle = async () => {
        const useNme = localStorage.getItem('name');
        const useId = localStorage.getItem('user_id');
        if (useNme == null || useId == null) {
          Router.push('../login');
          return;
        }
        const send_data = {
          "user_id": useId
        }
        try {
            const response = await axios({
                method: "POST",
                url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/get-user-order-detail-web-bo.php",
                data: send_data
            });
            console.log(response, 'hulu');
            if(response.data.response == "1"){
                setOrderId(response.data.order_id);
            }
        } catch (err) {
            console.log(err);
        }
    };

    useEffect(() => {
        getBundle();
    }, []);

    return (
        <div>
            <div className="thank_section">
                <div className="container">
                    <div className="row justify-content-center">
                        <div className="col-lg-12">
                            <div className="thank_thum">
                                <img src="https://i.ibb.co/X5MDH2Z/4354179-1.png" className="img-fluid" alt="" />
                            </div>
                            <div className="thank_content">
                                <h4>Ah! You&apos;re Awesome
                                    That&apos;s what we love to see</h4>
                                <p>Your Order is Placed Successfully.
                                    ORDER ID IS <span>#{orderId}</span></p>
                            </div>
                            <div className="thank_btn">
                                <button onClick={() => Router.push('/bundleCreator')} className="shopping_btn">Continue Shopping <img src="./image/right_arrow.png"
                                    alt="" /></button>
                            </div>
                            {/* <div className="thank_btn">
                                <button className="bookings_btn">See Bookings</button>
                            </div> */}
                        </div>
                    </div>

                </div>

            </div>
        </div>
    );
}

export default ThanksPage;