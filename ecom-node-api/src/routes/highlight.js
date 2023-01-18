const express = require('express');
const { requireSignin, adminMiddleware } = require('../common-middleware');
const { addHighlight, getHighlight, deleteHighlight, deleteHighlightAll } = require('../controller/highlight');
// const multer = require('multer');
const shortid = require('shortid');
const path = require('path');
const router = express.Router();
const upload = require("../../utils/multer");


// const storage = multer.diskStorage({
//     destination: function (req, file, cb) {
//         cb(null, path.join(path.dirname(__dirname), 'uploads/slider'))
//     },
//     filename: function (req, file, cb) {
//         cb(null, shortid.generate() + '-' + file.originalname)
//     }
// });

// const upload = multer({ storage });

// router.post('/category/create', requireSignin, adminMiddleware, upload.single('categoryImage'), addCategory1);

router.post('/highlight/create', requireSignin, upload.single('highlightImage'), addHighlight);

router.get('/highlight/get', getHighlight);

router.post('/highlight/delete', requireSignin, deleteHighlight);
router.post('/highlight/deleteall', requireSignin, deleteHighlightAll);



// router.post('/category/update', upload.array('categoryImage'), updateCategories);
// router.post('/category/delete', deleteCategories);

module.exports = router;