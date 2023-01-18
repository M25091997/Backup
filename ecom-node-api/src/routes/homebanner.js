const express = require('express');
const mongoose = require('mongoose');
const Category = require('../models/category');


const { requireSignin, adminMiddleware } = require('../common-middleware');
const { addSlider, getSlider, updateSlider, deleteSlider } = require('../controller/slider');
// const multer = require('multer');
const shortid = require('shortid');
const path = require('path');
const router = express.Router();
// const cloudinary = require("../../utils/cloudinary");
const upload = require("../../utils/multer");

const Homebanner = require('../models/homebanner');
const slugify = require('slugify');

const cloudinary = require("../../utils/cloudinary");

router.post('/homebanner/create', requireSignin, upload.single('homebanner'), async (req, res) => {
//    console.log('hi');
    const result = await cloudinary.uploader.upload(req.file.path, { folder: 'ecomnode/banner' });
    let bannerObj = {};
    if (req.file) {
        bannerObj.homebanner = result.secure_url;
    }

    const banner = new Homebanner(bannerObj);
    banner.save((error, homebanner) => {
        if (error) return res.status(400).json({ error });
        if (homebanner) {
            return res.status(201).json({ homebanner });
        }
    });
});

router.post('/clearancezone/update', requireSignin, upload.single('clearancezoneImage'), async (req, res) => {
    const clearancezone_id = req.body.clearancezone_id;
    if (
        !(
            clearancezone_id && mongoose.isValidObjectId(clearancezone_id)
        )
    ) {
        return res.status(400).json({
            success: false,
            message: " wrong clearancezone_id " + clearancezone_id,
        });
    }

    const result = await cloudinary.uploader.upload(req.file.path, { folder: 'ecomnode/clearancezone' });

    const sliderObj = {
        name: req.body.name,
        description: req.body.description
    }

    if (req.file) {
        sliderObj.clearancezoneImage = result.secure_url;
    }
    
    const updatedclearancezone = await Clearancezone.findOneAndUpdate({ _id: req.body.clearancezone_id }, sliderObj, { new: true });
    return res.status(201).json({ updatedclearancezone: updatedclearancezone });
});

router.get('/homebanner/get', async(req, res) => {
    
    Homebanner.find({})
        .exec((error, homebanner) => {
            if (error) return res.status(400).json({ error });
            if (homebanner) {
                return res.status(201).json({ homebanner });
            }
        })
});

router.post('/clearancezone/getclearancezoneById', (req, res) => {
    const clearancezone_id = req.body.clearancezone_id;
    if (
        !(
            clearancezone_id && mongoose.isValidObjectId(clearancezone_id)
        )
    ) {
        return res.status(400).json({
            success: false,
            message: " wrong clearancezone_id " + clearancezone_id,
        });
    }
    Clearancezone.findById(clearancezone_id)
        .exec((error, clearancezone) => {
            if (error) return res.status(400).json({ error });
            if (clearancezone) {
                return res.status(201).json({ clearancezone });
            }
        })
});

router.post('/clearancezone/delete', async (req, res) => {
    const { clearancezone_id } = req.body;
    if (
        !(
            clearancezone_id && mongoose.isValidObjectId(clearancezone_id)
        )
    ) {
        return res.status(400).json({
            success: false,
            message: " wrong clearancezone_id " + clearancezone_id,
        });
    }
    // res.json(_id);
    // return;
    const deleteSlider = await Clearancezone.findOneAndDelete({ _id: clearancezone_id });
    // res.json(deleteSlider);
    // return;
    if (deleteSlider) {
        res.status(201).json({ message: 'clearancezone deleted Successfully' });
    } else {
        res.status(400).json({ message: 'Something wrong in clearancezone deletion' });
    }

});


// router.post('/category/update', upload.array('categoryImage'), updateCategories);
// router.post('/category/delete', deleteCategories);

module.exports = router;