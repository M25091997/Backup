const express = require('express');
const { requireSignin, adminMiddleware } = require('../common-middleware');
const { createCity, updateCity, getCity, deleteCity } = require('../controller/city');
// const multer = require('multer');
const shortid = require('shortid');
const path = require('path');
const router = express.Router();
const upload = require("../../utils/multer");


// const storage = multer.diskStorage({
//     destination: function (req, file, cb) {
//         cb(null, path.join(path.dirname(__dirname), 'uploads/city'))
//     },
//     filename: function (req, file, cb) {
//         cb(null, shortid.generate() + '-' + file.originalname)
//     }
// });

// const upload = multer({ storage });

// router.post('/product/create', requireSignin, adminMiddleware, upload.array('productPicture'), createCoursenotes);
router.post('/city/create', requireSignin, upload.single('cityImage'), createCity);
router.post('/city/update', requireSignin, upload.single('cityImage'), updateCity);

router.get('/city/get', getCity);

router.post('/city/delete', deleteCity);



// router.get('/Products/:slug', getProductsBySlug);
// router.get('/category/getcategory', getCategories);

module.exports = router;