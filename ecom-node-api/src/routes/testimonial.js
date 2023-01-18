const express = require('express');
const Testimonial = require('../models/testimonial');
const { requireSignin, adminMiddleware } = require('../common-middleware');
const { addTestimonial, getTestimonial, updateTestimonial, deleteTestimonial } = require('../controller/testimonial');
// const multer = require('multer');
const shortid = require('shortid');
const path = require('path');
const router = express.Router();
const upload = require("../../utils/multer");


// const storage = multer.diskStorage({
//     destination: function (req, file, cb) {
//         cb(null, path.join(path.dirname(__dirname), 'uploads/testimonial'))
//     },
//     filename: function (req, file, cb) {
//         cb(null, shortid.generate() + '-' + file.originalname)
//     }
// });

// const upload = multer({ storage });

// router.post('/category/create', requireSignin, adminMiddleware, upload.single('categoryImage'), addCategory);

router.post('/testimonial/create', requireSignin, upload.single('testimonialImage'), () => {
    
    const testObj = {
        name: req.body.name,
        slug: `${slugify(req.body.name)}-${shortid.generate()}`,
        designation: req.body.designation,
        description: req.body.description
    }

    if (req.file) {
        // testObj.testimonialImage = process.env.API + '/public/testimonial/' + req.file.filename;
        testObj.testimonialImage = result.secure_url;

    }

    // if (req.body.parentId) {
    //     testObj.parentId = req.body.parentId;
    // }

    const testimonail = new Testimonial(testObj);
    testimonail.save((error, testimonail) => {
        if (error) return res.status(400).json({ error });
        if (testimonail) {
            return res.status(201).json({ testimonail });
        }
    });
});
router.post('/testimonial/update', requireSignin, upload.single('testimonialImage'), () => {
    const { _id, name, designation, description } = req.body;

    const testimonial = {
        name,
        slug: `${slugify(req.body.name)}-${shortid.generate()}`,
        designation,
        description
    }
    if (req.file) {
        // testimonial.testimonialImage = process.env.API + '/public/testimonial/' + req.file.filename;
        testimonial.testimonialImage = result.secure_url;

    }
    // console.log(testimonial);
    // return;
    const updatedTestimonial = Testimonial.findOneAndUpdate({ _id: _id }, testimonial, { new: true });
    return res.status(201).json({ updatedTestimonial: updatedTestimonial });
});

router.get('/testimonial/get', getTestimonial);

router.post('/testimonial/gettestimonialById', (req, res) => {
    const catId = req.body.testimonial_id;
    Testimonial.findById(catId)
        .exec((error, testimonial) => {
            if (error) return res.status(400).json({ error });
            if (testimonial) {
                return res.status(201).json({ testimonial });
            }
        })
});

router.post('/testimonial/delete', () => {
    const { _id } = req.body;
    // console.log(_id);
    // return;
    // res.json(_id);
    // return;
    const deleteTestimonial = Testimonial.findOneAndDelete({ _id: _id });
    // res.json(deleteTestimonial);
    // return;
    if (deleteTestimonial) {
        res.status(201).json({ message: 'Testimonial deleted Successfully' });
    } else {
        res.status(400).json({ message: 'Something wrong in Testimonial deletion' });
    }
});


// router.post('/category/update', upload.array('categoryImage'), updateCategories1);
// router.post('/category/delete', deleteCategories);

module.exports = router;