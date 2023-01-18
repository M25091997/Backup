import React from 'react';
import { useSelector } from 'react-redux';
import { generatePublicUrl } from '../../../../helpers/urlConfig';
import Link from 'next/link';
import moment from 'moment';


const Notification = () => {
    const initialData = useSelector(state => state.initialData);
    const genLinkUrl = (slug) => {
        return `tutor-detail/${slug}`;
    }
    return (
        <div className="cartmini__area">
            <div className="cartmini__wrapper">
                <div className="cartmini__title">
                    <h4>Notification Panel</h4>
                </div>
                <div className="cartmini__close">
                    <button type="button" className="cartmini__close-btn"><i className="fal fa-times"></i></button>
                </div>
                <div className="cartmini__widget">
                    <div className="cartmini__inner">
                        <ul>
                            {
                                initialData.notification && initialData.notification.length > 0 ?
                                    initialData.notification.map(noti =>
                                        <li>
                                            <div className="cartmini__thumb">
                                                <a href="#">
                                                    <img src="assets/img/course/sm/cart-1.jpg" alt="" />
                                                </a>
                                            </div>
                                            <div className="cartmini__content">
                                                <h5><a href="#">{noti.content} </a></h5>

                                                <div className="product__sm-price-wrapper">
                                                    <span className="product__sm-price">
                                                        {

                                                            moment(Date.parse(noti.notifi_date)).format('ll')

                                                        }
                                                    </span>
                                                </div>
                                            </div>

                                        </li>
                                    ) : null
                            }

                        </ul>
                    </div>

                </div>
            </div>
        </div>
    )
}

export default Notification;
