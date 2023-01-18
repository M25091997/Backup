const express = require('express');
const mongoose = require('mongoose');

const router = express.Router();
const upload = require("../../utils/multer");

const Clearancezonecategoryimage = require('../models/clearancezonecategoryimage');


router.post('/clearancezonecategoryimage/create', requireSignin, async (req, res) => {
    let sliderObj = {};
    if (req.file) {
        sliderObj.clearancezonecategoryImage = result.secure_url;
    }
    const slide = new Clearancezonecategoryimage(sliderObj);
    slide.save((error, clearancezonecategory) => {
        if (error) return res.status(400).json({ error });
        if (clearancezonecategory) {
            return res.status(201).json({ clearancezonecategory });
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

    if (req.file) {
        sliderObj.clearancezoneImage = result.secure_url;
    }
    
    const updatedclearancezone = await Clearancezone.findOneAndUpdate({ _id: req.body.clearancezone_id }, sliderObj, { new: true });
    return res.status(201).json({ updatedclearancezone: updatedclearancezone });
});

router.get('/clearancezonecategoryimage/get', async(req, res) => {
    
    Clearancezonecategoryimage.find({})
        .exec((error, clearancezonecatimage) => {
            if (error) return res.status(400).json({ error });
            if (clearancezonecatimage) {
                return res.status(201).json({ clearancezonecatimage });
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
   
    const deleteSlider = await Clearancezone.findOneAndDelete({ _id: clearancezone_id });
   
    if (deleteSlider) {
        res.status(201).json({ message: 'clearancezone deleted Successfully' });
    } else {
        res.status(400).json({ message: 'Something wrong in clearancezone deletion' });
    }

});


module.exports = router;