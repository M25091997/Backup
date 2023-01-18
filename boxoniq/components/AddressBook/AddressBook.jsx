import { Button } from "react-bootstrap";
import Addresscontent from "./sections/Addresscontent";
import Router from 'next/router';

const AddressBook = () => {
  const addAddress = () => {
    Router.push('/newAddress');
  }
  return (
    <div className="profile_section">
      <div className="container-fluid p_50">
        <div className="row">
          <div className="col-lg-12">
            <div className="global_header text-center history_header py-lg-5">
              <h4 className="global_herder_title">Address Book</h4>
            </div>
          </div>

          <div className="colg-lg-12">
            <div className="row">
              <div className="col-lg-5">
                <div className=" ">
                  <div className="add_new_add_btn_area mb-3 pt-5 pt-lg-0">
                    <Button className="common_btn_btn  w-100 d-flex justify-content-around">
                      <span>Saved Address</span> <span>2</span>{" "}
                    </Button>
                  </div>
                  <div className="add_new_add_btn_area pt-3 pb-5  pt-lg-0 pb-lg-0">
                    <button onClick={() => addAddress()} className="common_btn_btn cancel_btn active_btn w-100 d-flex justify-content-around">
                      <span>Add Address</span> <span></span>
                    </button>
                  </div>
                </div>
              </div>

              <div className="col-lg-7">
                <Addresscontent/>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default AddressBook;
