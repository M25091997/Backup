const express = require('express');
const { requireSignin, adminMiddleware } = require('../common-middleware');
const { createCourse, getCourse } = require('../controller/course');
const multer = require('multer');
const shortid = require('shortid');
const path = require('path');
const router = express.Router();

const storage = multer.diskStorage({
    destination: function (req, file, cb) {
        cb(null, path.join(path.dirname(__dirname), 'uploads/course'))
    },
    filename: function (req, file, cb) {
        cb(null, shortid.generate() + '-' + file.originalname)
    }
});

const upload = multer({ storage });

// router.post('/product/create', requireSignin, adminMiddleware, upload.array('productPicture'), createCourse);
router.post('/course/create', requireSignin, upload.single('courseImage'), createCourse);
router.get('/course/getcourse', getCourse);


// router.get('/Products/:slug', getProductsBySlug);
// router.get('/category/getcategory', getCategories);

module.exports = router;