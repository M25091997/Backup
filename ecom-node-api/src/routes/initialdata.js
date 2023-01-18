const express = require('express');
const { requireSignin, adminMiddleware } = require('../common-middleware');
const { getInitialdata } = require('../controller/initialdata');
const multer = require('multer');
const shortid = require('shortid');
const path = require('path');
const router = express.Router();

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

// router.post('/testimonial/create', requireSignin, upload.single('testimonialImage'), addTestimonial);
// router.post('/testimonial/update', requireSignin, upload.single('testimonialImage'), updateTestimonial);



router.get('/initialdata/get', getInitialdata);

// router.post('/category/update', upload.array('categoryImage'), updateCategories);
// router.post('/category/delete', deleteCategories);

module.exports = router;