import React, { useState, useEffect } from 'react';
import Link from 'next/link';
import { useDispatch, useSelector } from 'react-redux';
// import { login } from '../../../redux/actions';
import axios from 'axios'



export default function Login() {

    const [avatar, setAvatar] = useState('');
    const [selectedFile, setSelectedFile] = useState();
    const [isSelected, setIsSelected] = useState(false);

    // const dispatch = useDispatch();

    const changeHandler = (event) => {
        setSelectedFile(event.target.files[0]);
        setIsSelected(true);
    };

    const uploadImage = (e) => {
        e.preventDefault();

        const formData = new FormData();
        formData.append('avatar', selectedFile);
        // console.log(formData);
        // return false;
        axios.post('https://cms.cybertizeweb.com/studyfocus/cybertechMedia/api/new-study-api/register/upload.php', formData)
            .then(function (response) {
                //handle success
                console.log(response)
                console.log("success")
            })
            .catch(function (response) {
                //handle error
                console.log(response)
                console.log("sorry")
            });

        // dispatch(login(user));
    }
    return (
        <>
            <section className="signup__area po-rel-z1 pt-100 pb-145">
                <div className="sign__shape">
                    <img className="man-1" src="/assets/img/icon/sign/man-1.png" alt="" />
                    <img className="man-2" src="/assets/img/icon/sign/man-2.png" alt="" />
                    <img className="circle" src="/assets/img/icon/sign/circle.png" alt="" />
                    <img className="zigzag" src="/assets/img/icon/sign/zigzag.png" alt="" />
                    <img className="dot" src="/assets/img/icon/sign/dot.png" alt="" />
                    <img className="bg" src="/assets/img/icon/sign/sign-up.png" alt="" />
                </div>
                <div className="container">
                    <div className="row">
                        <div className="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2">
                            <div className="section__title-wrapper text-center mb-55">
                                <h2 className="section__title">Sign in to <br />  Study Focus</h2>
                                <p>it you don't have an account you can <Link href="/signup">Register here!</Link></p>
                            </div>
                        </div>
                    </div>
                    <div className="row">
                        <div className="col-xxl-6 offset-xxl-3 col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                            <div className="sign__wrapper white-bg">

                                <div className="sign__form">
                                    <form onSubmit={uploadImage}>
                                        <div className="sign__input-wrapper mb-25">
                                            <h5>Test Image Upload</h5>
                                        </div>
                                        <input type="file" name="file" onChange={changeHandler} />
                                        {isSelected ? (
                                            <div>
                                                <p>Filename: {selectedFile.name}</p>
                                                <p>Filetype: {selectedFile.type}</p>
                                                <p>Size in bytes: {selectedFile.size}</p>
                                                <p>
                                                    lastModifiedDate:{' '}
                                                    {selectedFile.lastModifiedDate.toLocaleDateString()}
                                                </p>
                                            </div>
                                        ) : (
                                            <p>Select a file to show details</p>
                                        )}

                                        <button className="e-btn  w-100"> <span></span> Upload Image</button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </>
    )
}