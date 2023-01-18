const express = require('express');

const { requireSignin, adminMiddleware } = require('../common-middleware');
const { addSlider, getSlider, updateSlider, deleteSlider } = require('../controller/slider');
// const multer = require('multer');
const shortid = require('shortid');
const path = require('path');
const router = express.Router();
// const cloudinary = require("../../utils/cloudinary");
const upload = require("../../utils/multer");

const Slider = require('../models/slider');
const slugify = require('slugify');


// const addSlider1 = async (req, res) => {

//     const sliderObj = {
//         name: req.body.name,
//         slug: `${slugify(req.body.name)}-${shortid.generate()}`
//     }

//     if (req.file) {
//         sliderObj.sliderImage = process.env.API + '/public/slider/' + req.file.filename;
//         sliderObj.sliderImage = result.secure_url;

//     }

//     if (req.body.parentId) {
//         sliderObj.parentId = req.body.parentId;
//     }

//     const slide = new Slider(sliderObj);
//     slide.save((error, slider) => {
//         if (error) return res.status(400).json({ error });
//         if (slider) {
//             return res.status(201).json({ slider });
//         }
//     });
// }

// const storage = multer.diskStorage({
//     destination: function (req, file, cb) {
//         cb(null, path.join(path.dirname(__dirname), 'uploads/slider'))
//     },
//     filename: function (req, file, cb) {
//         cb(null, shortid.generate() + '-' + file.originalname)
//     }
// });

// const upload = multer({ storage });

// router.post('/category/create', requireSignin, adminMiddleware, upload.single('categoryImage'), addCategory);

router.post('/slider/create', requireSignin, upload.single('sliderImage'), async (req, res) => {
    const sliderObj = {
        name: req.body.name,
        slug: `${slugify(req.body.name)}-${shortid.generate()}`
    }

    if (req.file) {
        // sliderObj.sliderImage = process.env.API + '/public/slider/' + req.file.filename;
        sliderObj.sliderImage = result.secure_url;
    }

    // if (req.body.parentId) {
    //     sliderObj.parentId = req.body.parentId;
    // }

    const slide = new Slider(sliderObj);
    slide.save((error, slider) => {
        if (error) return res.status(400).json({ error });
        if (slider) {
            return res.status(201).json({ slider });
        }
    });
});
router.post('/slider/update', requireSignin, upload.single('sliderImage'), async (req, res) => {

    const { _id, name } = req.body;
    const slider = {
        name,
        slug: `${slugify(req.body.name)}-${shortid.generate()}`
    }
    if (req.file) {
        // slider.sliderImage = process.env.API + '/public/slider/' + req.file.filename;
        slider.sliderImage = result.secure_url;

    }
    // console.log(slider);
    // return;
    const updatedSlider = await Slider.findOneAndUpdate({ _id: _id }, slider, { new: true });
    return res.status(201).json({ updatedSlider: updatedSlider });
});

router.get('/slider/getslider', (req, res) => {
    Slider.find({})
        .exec((error, sliders) => {
            if (error) return res.status(400).json({ error });
            if (sliders) {
                // const categoryList = createCategories(categories);
                const slider = sliders;
                return res.status(201).json({ slider });
            }
        })
});

router.post('/slider/getsliderById', (req, res) => {
    const catId = req.body.slider_id;
    Slider.findById(catId)
        .exec((error, slider) => {
            if (error) return res.status(400).json({ error });
            if (slider) {
                return res.status(201).json({ slider });
            }
        })
});

router.post('/slider/delete', async (req, res) => {
    const { _id } = req.body;
    // res.json(_id);
    // return;
    const deleteSlider = await Slider.findOneAndDelete({ _id: _id });
    // res.json(deleteSlider);
    // return;
    if (deleteSlider) {
        res.status(201).json({ message: 'Slider deleted Successfully' });
    } else {
        res.status(400).json({ message: 'Something wrong in Slider deletion' });
    }

});


// router.post('/category/update', upload.array('categoryImage'), updateCategories);
// router.post('/category/delete', deleteCategories);

module.exports = router;