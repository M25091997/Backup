const express = require('express');
const { requireSignin, adminMiddleware } = require('../common-middleware');
const { addCountry, getCountry, updateCountry, deleteCountry } = require('../controller/country');
// const multer = require('multer');
const shortid = require('shortid');
const path = require('path');
const router = express.Router();

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

router.post('/country/create', requireSignin, addCountry);
router.post('/country/update', requireSignin, updateCountry);

router.get('/country/get', getCountry);

router.post('/country/delete', deleteCountry);


// router.post('/category/update', upload.array('categoryImage'), updateCategories);
// router.post('/category/delete', deleteCategories);

module.exports = router;