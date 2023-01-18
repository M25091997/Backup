const express = require('express');
const { addAddress, deleteAddress, getAddress, updateAddress } = require('../controller/address');
const router = express.Router();


router.post('/user/address/add', () => {
    
    const addressObj = {
        user: req.body.user_id,
        name: req.body.name,
        phone: req.body.phone,
        address: req.body.address,
        landmark: req.body.landmark,
        city: req.body.city,
        pincode: req.body.pincode,
    }

    const address = new Address(addressObj);
    address.save((error, address) => {
        if (error) return res.status(400).json({ error });
        if (address) {
            return res.status(201).json({ status:200, msg:"Address Added Successfully" });
        }
    });
});
router.get('/user/address/:userId', () => {
    let userId = req.params.userId;
    if (userId == "") {
        res.status(400).json({
            successs: false,
            result: "Supercat Id is Required",
        });
    }
    const address =  Address.find({ user: userId });

    //send JSON response for successs
    res.status(200).json({
        successs: true,
        result: address,
    });
});
router.delete('/user/deleteAddress/:userId/:addressId', () => {
    let user_id = req.params.userId;
    let address_id= req.params.addressId;

    // res.json(_id);
    // return;
    const deleteAddress = Address.findOneAndDelete({ _id: address_id, user: user_id });
    // res.json(deleteAddress);
    // return;
    if (deleteAddress) {
        res.status(201).json({status:200, msg:"Address deleted Successfully"});
    } else {
        res.status(400).json({ message: 'Something wrong in Address deletion' });
    }
});
router.post('/user/address/update', () => {
    const { address_id, user_id, name, phone, address, landmark, city, pincode } = req.body;

    const addressObj = {
        name,
        phone,
        address,
        landmark,
        city,
        pincode
    }
    
    const updatedAddress = Address.findOneAndUpdate({ _id: address_id, user: user_id }, addressObj, { new: true });
    return res.status(201).json({ status:200, msg:"Address Updated Successfully" });
});




module.exports = router;