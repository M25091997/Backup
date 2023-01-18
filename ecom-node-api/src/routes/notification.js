const express = require('express');
const mongoose = require('mongoose');

const { requireSignin, adminMiddleware } = require('../common-middleware');
const shortid = require('shortid');
const path = require('path');
const router = express.Router();
const upload = require("../../utils/multer");

const Notification = require('../models/notification');


router.post('/notification/create', requireSignin, upload.single('notificationImage'), async (req, res) => {
    const sliderObj = {
        name: req.body.name,
        description: req.body.description
    }

    if (req.file) {
        sliderObj.notificationImage = result.secure_url;
    }

    const slide = new Notification(sliderObj);
    slide.save((error, slider) => {
        if (error) return res.status(400).json({ error });
        if (slider) {
            return res.status(201).json({ slider });
        }
    });
});

router.post('/notification/update', requireSignin, upload.single('notificationImage'), async (req, res) => {
    const notification_id = req.body.notification_id;
    if (
        !(
            notification_id && mongoose.isValidObjectId(notification_id)
        )
    ) {
        return res.status(400).json({
            success: false,
            message: " wrong notification_id " + notification_id,
        });
    }


    const sliderObj = {
        name: req.body.name,
        description: req.body.description
    }

   
    
    const updatedNotification = await Notification.findOneAndUpdate({ _id: req.body.notification_id }, sliderObj, { new: true });
    return res.status(201).json({ updatedNotification: updatedNotification });
});

router.get('/notification/get', (req, res) => {
    Notification.find({})
        .exec((error, notification) => {
            if (error) return res.status(400).json({ error });
            if (notification) {
                return res.status(201).json({ notification });
            }
        })
});

router.post('/notification/getnotificationById', (req, res) => {
    const notification_id = req.body.notification_id;
    if (
        !(
            notification_id && mongoose.isValidObjectId(notification_id)
        )
    ) {
        return res.status(400).json({
            success: false,
            message: " wrong notification_id " + notification_id,
        });
    }
    Notification.findById(notification_id)
        .exec((error, notification) => {
            if (error) return res.status(400).json({ error });
            if (notification) {
                return res.status(201).json({ notification });
            }
        })
});

router.post('/notification/delete', async (req, res) => {
    const { notification_id } = req.body;
    if (
        !(
            notification_id && mongoose.isValidObjectId(notification_id)
        )
    ) {
        return res.status(400).json({
            success: false,
            message: " wrong notification_id " + notification_id,
        });
    }
 
    const deleteSlider = await Notification.findOneAndDelete({ _id: notification_id });
    
    if (deleteSlider) {
        res.status(201).json({ message: 'Notification deleted Successfully' });
    } else {
        res.status(400).json({ message: 'Something wrong in Notification deletion' });
    }

});



module.exports = router;