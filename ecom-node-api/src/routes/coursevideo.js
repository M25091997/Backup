const express = require('express');
const { requireSignin, adminMiddleware } = require('../common-middleware');
const { createCoursevideo, getCoursevideo } = require('../controller/coursevideo');
const multer = require('multer');
const shortid = require('shortid');
const path = require('path');
const router = express.Router();

const storage = multer.diskStorage({
    destination: function (req, file, cb) {
        cb(null, path.join(path.dirname(__dirname), 'uploads/coursevideo'))
    },
    filename: function (req, file, cb) {
        cb(null, shortid.generate() + '-' + file.originalname)
    }
});

const upload = multer({ storage });

// router.post('/product/create', requireSignin, adminMiddleware, upload.array('productPicture'), createCoursevideo);
router.post('/coursevideo/create', requireSignin, upload.fields([{ name: 'coursevideoImage' }, { name: 'courseVideo' }]), createCoursevideo);
router.get('/coursevideo/get', getCoursevideo);


// router.get('/Products/:slug', getProductsBySlug);
// router.get('/category/getcategory', getCategories);

module.exports = router;