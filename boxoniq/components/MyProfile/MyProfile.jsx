import { useState, useEffect } from "react";
import axios from "axios";
import Router from 'next/router';

const MyProfile = () => {
  
  const [userId, setUserId] = useState('');
  const [userData, setUserData] = useState('');

  const getProfile = async () => {
    const useNme = localStorage.getItem('name');
    const useId = localStorage.getItem('user_id');
    if (useNme == null || useId == null) {
      Router.push('../login');
      return;
    }
    setUserId(useId);
    const send_data = {
      "user_id": useId
    }
    try {
      const response = await axios({
        method: "POST",
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/get-user-web-bo.php",
        data: send_data
      });
      console.log(response, 'hulu');
      if(response.data.response == '1'){
        setUserData(response.data);
      }
    } catch (err) {
      console.log(err);
    }
  };

  useEffect(() => {
    getProfile();
  }, []);


  return (
    <div>
      <section className="my_profile">
        <div className="my_profile_color">
          <div className="container">
            <div className="row">
              <div className="col-12 col-lg-12">
                <div className="my_profile_title text-center py-4 py-lg-5">
                  <h3>My Profile</h3>
                </div>
              </div>
            </div>
            <div className="row mt-4 mb-5 mb-lg-0 mt-lg-3 mb-lg-5 d-flex justify-content-center">
              <div className="col-lg-11 mt-5 mt-lg-0 mb-lg-5">
                <div className="my_profile_content mb-lg-5">
                  <div className="row">
                    <div className="col-lg-4">
                      <div className="my_profile_img">
                        <img
                          src={userData.img}
                          className="img-fluid"
                          alt=""
                        />
                      </div>
                    </div>
                    <div className="col-lg-8 ">
                      <div className="profile_contents d-flex justify-content-between">
                        <div className="left_contents">
                          <h3>Name</h3>
                          <h3>Mob. no</h3>
                          <h3>Email</h3>
                          <h3>Baby Name</h3>
                          <h3>Baby Date of Birth</h3>
                          <h3>Referral Code</h3>

                        </div>
                        {userData && userData!="" ? 
                          <div className="right_contents">
                            <h4>{userData.name}</h4>
                            <h4>{userData.phone}</h4>
                            <h4>{userData.email}</h4>
                            <h4>{userData.baby_name}</h4>
                            <h4>{userData.baby_dob}</h4>
                            <h4>{userData.refer_code}</h4>
                          </div>
                         : ""}
                      </div>
                      <div className="row">
                        <div className="col-lg-12">
                          <div className="edit-button mt-4">
                            <button className="btn" onClick={() => Router.push('/editProfile')}>Edit</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
};

export default MyProfile;
