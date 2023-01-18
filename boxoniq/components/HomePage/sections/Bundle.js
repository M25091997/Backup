import { useState, useEffect } from "react";
import axios from "axios";
import BundleShim from './BundleShim';
import Router from "next/router";



const Bundle = () => {
    const [bundleData, setBundleData] = useState([]);
    const [bundletextData, setBundletextData] = useState('');
    const [bundledescData, setBundledescData] = useState('');

    const changeBundle = (name, descrip) => {
        setBundletextData(name);
        setBundledescData(descrip);
    }

    const goToBundle = () => {
        Router.push('bundleCreator');
    }

    const getBundle = async() => {
        try {
            const response = await axios({
                method: "GET",
                url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/get-home-bundle-benefit-bo.php"
            });
            console.log(response, 'hulu');
            setBundleData(response.data);
            setBundletextData(response.data[0].name);
            setBundledescData(response.data[0].desc);

        } catch (err) {
            console.log(err);
        }
    };
    useEffect(() => {
        getBundle();
    }, []);
  return (
      <section className="bundle-container">
          <h1 className="title">BUNDLE BENEFITS</h1>
          <div className="row d-flex justify-content-between ">
              <div className="col-8 col-sm-5 col-md-5 col-lg-5 d-flex flex-column justify-content-center">
                  {bundleData && bundleData.length > 0 ? bundleData.map((item) => {
                    return (
                        <div key={item.id} className="shape shadow" onMouseEnter={() => changeBundle(item.name, item.desc)}>
                            <div className="shape-title">
                                <p style={{fontSize:"20px", fontWeight:"800"}}>{item.name}</p>
                                <p className="d-block">
                                    {item.desc}
                                </p>
                            </div>

                            <div className="banifit-box">
                                <img src={item.image} alt="" />
                            </div>
                        </div>
                    )
                  }) : 
                  <>
                          <BundleShim />
                          <BundleShim />
                          <BundleShim />
                  </>

                  }
                  
              </div>
              <div className="col-4 col-sm-7 col-md-7 col-lg-7">
                  <div className="shape-left">
                      <img
                          className=""
                          src="images/pexels-daniel-reche-1556706 1.png"
                          alt=""
                      />
                  </div>
                  <div className="banifit-right bundle-right mb-0 mb-lg-5 mb-xl-5">
                      <h1>{bundletextData}</h1>
                      <p>
                          {bundledescData}
                      </p>
                      <button onClick={() => goToBundle()}>
                          Start Your Bundle
                          <img
                              className="ms-2 start_bundle_img"
                              src="https://i.ibb.co/HrXYz5D/Arrow-2.png"
                              alt=""
                          />
                      </button>
                  </div>
              </div>
              {/* <div className="col-2 col-md-6 bundle-right-img">
            <img
              className="w-100"
              src="https://i.ibb.co/dJ0CMxM/pexels-daniel-reche-1556706-1.png"
              alt=""
            />
          </div> */}
          </div>
      </section>
  )
}

export default Bundle