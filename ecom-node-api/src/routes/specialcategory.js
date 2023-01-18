const express = require('express');
const mongoose = require('mongoose');

const { requireSignin, adminMiddleware } = require('../common-middleware');
const { addCategory, getCategories, updateCategory, deleteCategory } = require('../controller/category');
// const multer = require('multer');
const shortid = require('shortid');
const path = require('path');
const router = express.Router();
const upload = require("../../utils/multer");

const SpecialCategory = require('../models/specialcategory');
const slugify = require('slugify');
const cloudinary = require("../../utils/cloudinary");

router.post('/specialcategory/create', requireSignin, async (req, res) => {
    try {

        const categoryObj = {
            name: req.body.name,
            slug: `${slugify(req.body.name)}-${shortid.generate()}`,
        }


        const cat = new SpecialCategory(categoryObj);
        cat.save((error, specialcategory) => {
            if (error) return res.status(400).json({ error });
            if (specialcategory) {
                return res.status(201).json({ specialcategory });
            }
        });
    }
    catch (err) {
        console.log(err);
    }
});

router.post('/specialcategory/update', requireSignin, async (req, res) => {


    const { _id, name } = req.body;
    const category = {
        name,
        slug: `${slugify(req.body.name)}-${shortid.generate()}`,
    }

    if (
        !(
          _id && mongoose.isValidObjectId(_id)
        )
      ) {
        return res.status(400).json({
          success: false,
          message: " wrong category_id ",
        });
      }

  
    const updatedSplCategory = await SpecialCategory.findOneAndUpdate({ _id: _id }, { new: true });
    return res.status(201).json({ updatedSplCategory: updatedSplCategory });
});



router.get('/specialcategory/get', (req, res) => {
    SpecialCategory.find({})
        .exec((error, specialcategories) => {
            if (error) return res.status(400).json({ error });
            if (specialcategories) {
                // const categoryList = createCategories(categories);
                // const cat = categories;
                return res.status(201).json({ specialcategories });
            }
        })
});

router.post('/specialcategory/getById', (req, res) => {
    const catId = req.body.category_id;
    if (
        !(
          catId && mongoose.isValidObjectId(catId)
        )
      ) {
        return res.status(400).json({
          success: false,
          message: " wrong category_id ",
        });
      }

      SpecialCategory.findById(catId)
        .exec((error, splcategory) => {
            if (error) return res.status(400).json({ error });
            if (splcategory) {
                return res.status(201).json({ splcategory });
            }
        })
});

router.post('/specialcategory/delete', async (req, res) => {
    const { _id } = req.body;
   
    const deleteCategory = await SpecialCategory.findOneAndDelete();
    // res.json(deleteCategory);
    // return;
    if (deleteCategory) {
        res.status(201).json({ message: 'Special Category deleted Successfully' });
    } else {
        res.status(400).json({ message: 'Something wrong in Special Category deletion' });
    }

});




module.exports = router;