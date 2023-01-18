const express = require('express');
const mongoose = require('mongoose');
const Category = require('../models/category');
const Clearancezonecategoryimage = require('../models/clearancezonecategoryimage');

const router = express.Router();
const upload = require("../../utils/multer");

const Clearancezone = require('../models/clearancezone');


router.post('/clearancezone/create', requireSignin, upload.single('clearancezoneImage'), async (req, res) => {
    const sliderObj = {
        name: req.body.name,
        description: req.body.description
    }

    const slide = new Clearancezone(sliderObj);
    slide.save((error, clearancezone) => {
        if (error) return res.status(400).json({ error });
        if (clearancezone) {
            return res.status(201).json({ clearancezone });
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

    const sliderObj = {
        name: req.body.name,
        description: req.body.description
    }

    const updatedclearancezone = await Clearancezone.findOneAndUpdate({ _id: req.body.clearancezone_id });
    return res.status(201).json({ updatedclearancezone: updatedclearancezone });
});

router.get('/clearancezone/get', async(req, res) => {
    let clearancezonecat = await Clearancezonecategoryimage.find({});
    Clearancezone.find({})
        .exec((error, clearancezone) => {
            if (error) return res.status(400).json({ error });
            if (clearancezone) {
                return res.status(201).json({ clearancezone, category, clearancezonecat });
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
  
    if (deleteSlider) {
        res.status(201).json({ message: 'clearancezone deleted Successfully' });
    } else {
        res.status(400).json({ message: 'Something wrong in clearancezone deletion' });
    }

});

module.exports = router;