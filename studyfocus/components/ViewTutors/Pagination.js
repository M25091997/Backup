import React, { useState, useEffect } from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { getViewAllTutorCity, setPageNo } from '../../redux/actions';
import { useRouter } from 'next/router';


const Pagination = (props) => {
    const router = useRouter();
    const { city, sub } = router.query;

    const dispatch = useDispatch();

    const tutor_count = props.x;
    // const tutor_count = 3000;

    const getPage = (page) => {
        // console.log(page);
        // return;
        // if (city != undefined) {
        const cId = {
            city_name: `${city}`,
            sub_name: `${sub}`,
            page_no: page
        }
        // }
        // console.log(cId);
        // return;

        try {
            dispatch(getViewAllTutorCity(cId));
            dispatch(setPageNo(page));
        } catch (e) {
            console.log(e);
        }

        scrollTop();

    }

    const scrollTop = () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    };

    if (tutor_count != null || tutor_count != undefined) {
        let count_tutor = 3000;
        let i = [];
        Array.from(Array(parseInt(tutor_count / 25)), (e, x) => {
            i.push(x);
        })
        // let i = [1,2,3,4,5,6,7,8,9,10,11,12];
        {console.log(i)}

            return(
        <ul className="d-flex align-items-center">
                {
                        (((tutor_count) / 25) > 9) ? i.slice(1, 11).map(x => 
                            <li onClick={() => getPage(x + 1)} key={x} className="">
                                <a>
                                    <span>{x + 1}</span>
                            </a>
                            </li>
                        ) : 
                        i.map(x => 
                            <li onClick={() => getPage(x + 1)} key={x} className="">
                                <a>
                                    <span>{x + 1}</span>
                                </a>
                            </li>
                        )
                }
                    {
                        tutor_count / 25 > 9 ? <button onClick={() => getPage(12)} className="btn btn-primary">Next</button> : ""
                    }
                    
            </ul>)

    } else {
        return <> </>
    }
    console.log('pagination called')
    return (<> </>)

}

export default Pagination;
