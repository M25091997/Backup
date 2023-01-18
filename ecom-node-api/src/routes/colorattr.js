const express = require('express');
const mongoose = require('mongoose');

const { requireSignin, adminMiddleware } = require('../common-middleware');
const { addCategory, getCategories, updateCategory, deleteCategory } = require('../controller/category');
// const multer = require('multer');
const shortid = require('shortid');
const path = require('path');
const router = express.Router();
const upload = require("../../utils/multer");

const ColorAttr = require('../models/colorattr');
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

router.post('/colorattribute/create', requireSignin, async (req, res) => {
    try {

        const categoryObj = {
            name: req.body.name,
            slug: `${slugify(req.body.name)}-${shortid.generate()}`,
        }

        const cat = new ColorAttr(categoryObj);
        cat.save((error, colorattribute) => {
            if (error) return res.status(200).json({ error });
            if (colorattribute) {
                return res.status(201).json({ colorattribute });
            }
        });
    }
    catch (err) {
        return res.status(400).json({ error });
    }
});

router.post('/colorattribute/getcolorattributeById', (req, res) => {
    const catId = req.body.color_id;
    if (
        !(
          catId && mongoose.isValidObjectId(catId)
        )
      ) {
        return res.status(400).json({
          success: false,
          message: " wrong color_id ",
        });
      }

      ColorAttr.findById(catId)
        .exec((error, colors) => {
            if (error) return res.status(400).json({ error });
            if (colors) {
                return res.status(201).json({ colors });
            }
        })
});


router.post('/colorattribute/update', requireSignin, async (req, res) => {

    const { _id, name } = req.body;
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
    const color = {
        name,
        slug: `${slugify(req.body.name)}-${shortid.generate()}`,
    }

    const updatedcolor = await ColorAttr.findOneAndUpdate({ _id: _id }, color, { new: true });
    return res.status(201).json({ updatedcolor: updatedcolor });
});


router.get('/colorattribute/get', (req, res) => {
    ColorAttr.find({})
        .exec((error, colorattributes) => {
            if (error) return res.status(400).json({ error });
            if (colorattributes) {
                return res.status(201).json({ colorattributes });
            }
        })
});

router.post('/colorattribute/delete', async (req, res) => {
    const { color_id } = req.body;
    if (
        !(
          color_id && mongoose.isValidObjectId(color_id)
        )
      ) {
        return res.status(400).json({
          success: false,
          message: " wrong color_id ",
        });
      }
    const deletecolorattribute = await ColorAttr.findOneAndDelete({ _id: color_id });
    
    if (deletecolorattribute) {
        res.status(201).json({ message: 'Colorattribute deleted Successfully' });
    } else {
        res.status(400).json({ message: 'Something wrong in Colorattribute deletion' });
    }

});



module.exports = router;