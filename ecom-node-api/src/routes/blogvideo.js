const express = require('express');
const { requireSignin, adminMiddleware } = require('../common-middleware');
const { createBlogvideo, getBlogvideo } = require('../controller/blogvideo');
const multer = require('multer');
const shortid = require('shortid');
const path = require('path');
const router = express.Router();

const storage = multer.diskStorage({
    destination: function (req, file, cb) {
        cb(null, path.join(path.dirname(__dirname), 'uploads/blogvideo'))
    },
    filename: function (req, file, cb) {
        cb(null, shortid.generate() + '-' + file.originalname)
    }
});

const upload = multer({ storage });

// router.post('/product/create', requireSignin, adminMiddleware, upload.array('productPicture'), createBlogvideo);
router.post('/blogvideo/create', requireSignin, upload.fields([{ name: 'blogvideoImage' }, { name: 'blogVideo' }]), createBlogvideo);
router.get('/blogvideo/get', getBlogvideo);


// router.get('/Products/:slug', getProductsBySlug);
// router.get('/category/getcategory', getCategories);

module.exports = router;