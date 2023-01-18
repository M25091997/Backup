import React, { useState, useEffect } from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { base_url } from '../../helpers/urlConfig';
import { getAdsData, getTutorAds, getViewAllTutorCity } from '../../redux/actions';
import Card from '../Card';
import axios from 'axios'



const Testads = () => {
    const dispatch = useDispatch();

    const chatData = useSelector(state => state.adchat);
    // const tutorsData = useSelector(state => state.viewAllTutor);
    // const [ads, setAds] = useState([]);

    // async function getAds() {
    //     axios.post('https://cms.cybertizeweb.com/adstudy/api/fetch_all_campaign.php')
    //     .then(function (response) {
    //         //handle success
    //         setAds(response.data);
    //         console.log("success")
    //     })
    //     .catch(function (response) {
    //         //handle error
    //         console.log(response);
    //         console.log("sorry")
    //     });
    //     // return;
    //     // const city = await res.json();

    // }

    

    // const adsData = useSelector(state => state.adchat);

    // const mergeAdsData = async() => {
    //     const a = tutorData.tutors;
    //     // const b = [{'title':'1'},{'title':'2'},{'title':'3'},{'title':'4'}];
    //     const b = adsData.chats;

    //     let c = [];

    //     // console.log(a);
    //     // console.log(b);
    //     // return;
       
    //     for( let index=0,arr2Index=0;index<a.length;index++){
    //         c.push(a[index]);
    //         if((index+1)%3===0){
    //             c.push(b[arr2Index]);
    //             arr2Index++;
    //         }
    //     }
    //     console.log(c);

    // }

    useEffect(async () => {
        // getAds();
        const ciId = {
                        city_name: 'India',
                        sub_name: '',
                        page_no: 1
                    }
        // console.log(ciId);
        try {

            await dispatch(getTutorAds(ciId));
            // await dispatch(getViewAllTutorCity(ciId));

            // await dispatch(getAdsData());
            // await mergeAdsData();

            // axios.post('https://cms.cybertizeweb.com/adstudy/api/fetch_all_campaign.php')
            // .then(function (response) {
            //     //handle success
            //     console.log(response)
            //     console.log("success")
            // })
            // .catch(function (response) {
            //     //handle error
            //     console.log(response)
            //     console.log("sorry")
            // });
            } catch (e) {
                console.log(e);
            }
                       
    }, []);
 

    return (
        <>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>

        {/* {
            console.log(chatData)
            console.log(tutorsData)
        } */}

        {/* <ul style={{display:'flex'}}>
            {
                console.log(ads)
            }
          {
                        ads && ads.length ? ads.map(chatitem =>
                            <h1 style={{marginLeft:'15px'}}>{chatitem.name}</h1>) : 
                            <center>
                                <img width={'50%'} src={base_url + "/assets/img/logo/notfound.jpg"} alt="logo" />
                            </center>
                }  
        </ul> */}

        <ul style={{display:'flex'}}>
            {
                console.log(chatData.chats)
            }
          {
                        chatData.chats && chatData.chats.length ? chatData.chats.map(chatitem =>
                            <h1 style={{marginLeft:'15px'}}>{chatitem.name}</h1>) : 
                            <center>
                                <img width={'50%'} src={base_url + "/assets/img/logo/notfound.jpg"} alt="logo" />
                            </center>
                }  
        </ul>

        <br/>
        <br/>

      
        {/* <ul style={{display:'flex'}}>
          {
                  
                        tutorsData.tutors && tutorsData.tutors.length ? tutorsData.tutors.map(tutor =>
                            <h1 style={{marginLeft:'15px'}}>{tutor.name}</h1>) : <center><img width={'50%'} src={base_url + "/assets/img/logo/notfound.jpg"} alt="logo" /></center>
                }  
        </ul> */}
        <br/>
        <br/>
        <br/>
        


        </>
    )
}

export default Testads
