const express = require('express');
const { requireSignin, adminMiddleware } = require('../common-middleware');
const { createCoursenotes, getCoursenotes } = require('../controller/coursenotes');
const multer = require('multer');
const shortid = require('shortid');
const path = require('path');
const router = express.Router();

const storage = multer.diskStorage({
    destination: function (req, file, cb) {
        cb(null, path.join(path.dirname(__dirname), 'uploads/coursenotes'))
    },
    filename: function (req, file, cb) {
        cb(null, shortid.generate() + '-' + file.originalname)
    }
});

const upload = multer({ storage });

// router.post('/product/create', requireSignin, adminMiddleware, upload.array('productPicture'), createCoursenotes);
router.post('/coursenotes/create', requireSignin, upload.single('courseNotes'), createCoursenotes);
router.get('/coursenotes/get', getCoursenotes);


// router.get('/Products/:slug', getProductsBySlug);
// router.get('/category/getcategory', getCategories);

module.exports = router;