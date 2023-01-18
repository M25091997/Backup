import React, { useState, useEffect } from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { getInitialSignup } from '../../redux/actions';

import { Modal, Button, Col, Form } from 'react-bootstrap';

const TestModal = () => {
    const [show, setShow] = useState(false);

    const handleClose = () => setShow(false);
    const handleShow = () => setShow(true);
    const [state, setState] = useState('');
    const [localCity, setlocalCity] = useState('');
    const [city, setCity] = useState([]);
    const [scity, setSCity] = useState('');

    const dispatch = useDispatch();
    const initialSignupData = useSelector(state => state.initialSignupData);

    const checkcity = () => {
        localStorage.setItem('localCity', 0);
    }

    useEffect(() => {
        dispatch(getInitialSignup());
        checkcity();
    }, []);

    // we will use async/await to fetch this data
    async function getCity(state) {
        const res = await fetch("https://studyfocus.in/cybertechMedia/api/new-study-api/city/city_fetchAll.php?state=" + state);
        const city = await res.json();

        setCity(city);
    }
    const handleCity = (state) => {
        setState(state);
        getCity(state);
    }

    const getCityValue = () => {
        localStorage.removeItem('localCity');
        alert(state);
        alert(scity);
        localStorage.setItem('localCity', scity);
    }

    const cityModal = () => {
        return (
            <div className="container">
                <div className="row">
                    <div className="col-md-12 bg-light">
                        <div className="row">
                            <div className="col-md-12 card-body">

                                <div className="row">
                                    <div className="col-md-6">
                                        <div className="sign__input-wrapper mb-25">
                                            <h5>Select State</h5>
                                            <Form.Group as={Col} >
                                                <Form.Control as="select" value={state} onChange={(e) => { handleCity(e.target.value); }} >
                                                    <option value="">Select State</option>
                                                    {
                                                        initialSignupData.states && initialSignupData.states.length > 0 ? initialSignupData.states.map(state =>

                                                            <option value={state.id}>{state.name}</option>

                                                        ) : ""
                                                    }
                                                </Form.Control>
                                            </Form.Group>
                                        </div>
                                    </div>
                                    <div className="col-md-6">
                                        <div className="sign__input-wrapper mb-25">
                                            <h5>Select City</h5>
                                            <Form.Group as={Col} >
                                                <Form.Control as="select" value={scity} onChange={(e) => { setSCity(e.target.value); }} >
                                                    <option value="">Select City</option>
                                                    {
                                                        city.data && city.data.length > 0 ? city.data.map(cit =>

                                                            <option value={cit.id}>{cit.name}</option>

                                                        ) : ""
                                                    }
                                                </Form.Control>
                                            </Form.Group>
                                        </div>
                                    </div>
                                </div>


                                <div className="row">
                                    <div className="col-md-12">
                                        <p> POPULAR CITIES</p>
                                    </div>
                                </div>
                                <div className="row">
                                    <div className="col-md-3">
                                        <button type="button" className="btn btn-link" style={{ fontSize: "10px", color: "#1a1a1a" }} > <i class="fa fa-map-marker" aria-hidden="true"></i> New Delhi</button></div>
                                    <div className="col-md-3">
                                        <button type="button" className="btn btn-link" style={{ fontSize: "10px", color: "#1a1a1a" }} > <i class="fa fa-map-marker" aria-hidden="true"></i> Chennai</button></div>
                                    <div className="col-md-3">
                                        <button type="button" className="btn btn-link" style={{ fontSize: "10px", color: "#1a1a1a" }} > <i class="fa fa-map-marker" aria-hidden="true"></i> Banglore</button></div>
                                    <div className="col-md-3">
                                        <button type="button" className="btn btn-link" style={{ fontSize: "10px", color: "#1a1a1a" }} > <i class="fa fa-map-marker" aria-hidden="true"></i> Jaipur</button></div>
                                    <div className="col-md-3">
                                        <button type="button" className="btn btn-link" style={{ fontSize: "10px", color: "#1a1a1a" }} > <i class="fa fa-map-marker" aria-hidden="true"></i> Mumbai</button></div>
                                    <div className="col-md-3">
                                        <button type="button" className="btn btn-link" style={{ fontSize: "10px", color: "#1a1a1a" }} > <i class="fa fa-map-marker" aria-hidden="true"></i> Kanpur</button></div>
                                    <div className="col-md-3">
                                        <button type="button" className="btn btn-link" style={{ fontSize: "10px", color: "#1a1a1a" }} > <i class="fa fa-map-marker" aria-hidden="true"></i> Kochi</button></div>
                                    <div className="col-md-3">
                                        <button type="button" className="btn btn-link" style={{ fontSize: "10px", color: "#1a1a1a" }} > <i class="fa fa-map-marker" aria-hidden="true"></i> Kolkata</button></div>
                                    <div className="col-md-3">
                                        <button type="button" className="btn btn-link" style={{ fontSize: "10px", color: "#1a1a1a" }} > <i class="fa fa-map-marker" aria-hidden="true"></i> Pune</button></div>
                                    <div className="col-md-3">
                                        <button type="button" className="btn btn-link" style={{ fontSize: "10px", color: "#1a1a1a" }} > <i class="fa fa-map-marker" aria-hidden="true"></i> Patna</button>
                                    </div>
                                    <div className="col-md-3">
                                        <button type="button" className="btn btn-link" style={{ fontSize: "10px", color: "#1a1a1a" }} > <i class="fa fa-map-marker" aria-hidden="true"></i> Surat</button></div>

                                    <div className="col-md-3">
                                        <button type="button" className="btn btn-link" style={{ fontSize: "10px", color: "#1a1a1a" }} > <i class="fa fa-map-marker" aria-hidden="true"></i> Nagpur</button></div>
                                    <div className="col-md-3">
                                        <button type="button" className="btn btn-link" style={{ fontSize: "10px", color: "#1a1a1a" }} > <i class="fa fa-map-marker" aria-hidden="true"></i> Hydrabad</button></div>
                                    <div className="col-md-4">
                                        <button type="button" className="btn btn-link" style={{ fontSize: "10px", color: "#1a1a1a" }} > <i class="fa fa-map-marker" aria-hidden="true"></i> Bhubaneswar</button></div>


                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        )
    }

    return (
        <>
            <Button variant="primary" onClick={handleShow}>
                Launch static backdrop modal
           </Button>

            <Modal
                show={show}
                onHide={handleClose}
                backdrop="static"
                keyboard={false}
            >
                <Modal.Header closeButton>
                    <Modal.Title>Location</Modal.Title>
                </Modal.Header>
                <Modal.Body>
                    {cityModal()}
                </Modal.Body>
                <Modal.Footer>
                    <Button variant="secondary" onClick={handleClose}>
                        Close
                    </Button>
                    <Button variant="primary" onClick={getCityValue}>Apply</Button>
                </Modal.Footer>
            </Modal>

        </>
    )
}

export default TestModal
