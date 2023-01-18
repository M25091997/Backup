const express = require('express');
const mongoose = require('mongoose');

const { requireSignin, adminMiddleware } = require('../common-middleware');
const { addCategory, getCategories, updateCategory, deleteCategory } = require('../controller/category');
// const multer = require('multer');
const shortid = require('shortid');
const path = require('path');
const router = express.Router();
const upload = require("../../utils/multer");

const SizeAttr = require('../models/sizeattr');
const slugify = require('slugify');
const cloudinary = require("../../utils/cloudinary");


// const storage = multer.diskStorage({
//   destination: function (req, file, cb) {
//     cb(null, path.join(path.dirname(__dirname), 'uploads/super-category'))
//   },
//   filename: function (req, file, cb) {
//     cb(null, shortid.generate() + '-' + file.originalname)
//   }
// });

// const upload = multer({ storage });

// const uploadCategory = (req, res) => {
//   if (req.file) {
//     // categoryObj.categoryImage = process.env.API + '/public/' + req.file.filename;
//     return res.status(201).json({ image: req.file.filename });
//   }
// }

// router.post('/category/create', requireSignin, adminMiddleware, upload.single('categoryImage'), addCategory);

router.post('/sizeattribute/create', requireSignin, async (req, res) => {
    try {

        const categoryObj = {
            name: req.body.name,
            slug: `${slugify(req.body.name)}-${shortid.generate()}`,
        }

        const cat = new SizeAttr(categoryObj);
        cat.save((error, sizeattribute) => {
            if (error) return res.status(400).json({ error });
            if (sizeattribute) {
                return res.status(201).json({ sizeattribute });
            }
        });
    }
    catch (err) {
        console.log(err);
    }
});

router.post('/sizeattribute/update', requireSignin, async (req, res) => {

    const { size_id, name } = req.body;
    if (
        !(
          size_id && mongoose.isValidObjectId(size_id)
        )
      ) {
        return res.status(400).json({
          success: false,
          message: " wrong size_id ",
        });
      }

    const Size = {
        name,
        slug: `${slugify(req.body.name)}-${shortid.generate()}`,
    }
  
    const updatedSize = await SizeAttr.findOneAndUpdate({ _id: size_id }, Size, { new: true });
    return res.status(201).json({ message: 'Size updated Successfully', updatedSize: updatedSize });
});

router.post('/sizeattribute/getsizeById', (req, res) => {
    const catId = req.body.size_id;
    if (
        !(
          catId && mongoose.isValidObjectId(catId)
        )
      ) {
        return res.status(400).json({
          success: false,
          message: " wrong size_id ",
        });
      }

      SizeAttr.findById(catId)
        .exec((error, sizes) => {
            if (error) return res.status(400).json({ error });
            if (sizes) {
                return res.status(201).json({ sizes });
            }
        })
});

router.get('/sizeattribute/get', (req, res) => {
    SizeAttr.find({})
        .exec((error, sizeattributes) => {
            if (error) return res.status(400).json({ error });
            if (sizeattributes) {
                return res.status(201).json({ sizeattributes });
            }
        })
});

router.post('/sizeattribute/delete', async (req, res) => {
    const { _id } = req.body;
    if (
        !(
          _id && mongoose.isValidObjectId(_id)
        )
      ) {
        return res.status(400).json({
          success: false,
          message: " wrong color_id ",
        });
      }

    const deleteSize = await SizeAttr.findOneAndDelete({ _id: _id });
    
    if (deleteSize) {
        res.status(201).json({ message: 'Size deleted Successfully' });
    } else {
        res.status(400).json({ message: 'Something wrong in Category deletion' });
    }

});

module.exports = router;