const express = require('express');
const mongoose = require('mongoose');

const { requireSignin, adminMiddleware } = require('../common-middleware');
const { addCategory, getCategories, updateCategory, deleteCategory } = require('../controller/category');
// const multer = require('multer');
const shortid = require('shortid');
const path = require('path');
const router = express.Router();
const upload = require("../../utils/multer");

const Category = require('../models/category');
const slugify = require('slugify');


router.post('/category/create', requireSignin, upload.single('categoryImage'), async (req, res) => {
    try {

        const categoryObj = {
            name: req.body.name,
            slug: `${slugify(req.body.name)}-${shortid.generate()}`,
        }

        if (req.file) {
            categoryObj.categoryImage = result.secure_url;
        }

        const cat = new Category(categoryObj);
        cat.save((error, category) => {
            if (error) return res.status(400).json({ error });
            if (category) {
                return res.status(201).json({ category });
            }
        });
    }
    catch (err) {
        return res.status(400).json({ err });
    }
});

router.post('/category/update', requireSignin, upload.single('categoryImage'), async (req, res) => {

    const { _id, name } = req.body;
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


   
    const category = {
        name,
        slug: `${slugify(req.body.name)}-${shortid.generate()}`,
    }

    if (req.file) {
        // category.categoryImage = process.env.API + '/public/super-category/' + req.file.filename;
        category.categoryImage = result.secure_url;

    }
    // console.log(place);
    // return;
    const updatedCategory = await Category.findOneAndUpdate({ _id: _id }, category, { new: true });
    return res.status(201).json({ status: 200, message : "Category successfully updated" });
});


// router.post('/category/upload', requireSignin, upload.single('category'), uploadCategory);

router.get('/category/getcategory', (req, res) => {
    Category.find({})
        .exec((error, categories) => {
            if (error) return res.status(400).json({ error });
            if (categories) {
                // const categoryList = createCategories(categories);
                // const cat = categories;
                return res.status(201).json({ categories });
            }
        })
});

router.get('/category/getcategoryvote', (req, res) => {
    Category.find({})
        .exec((error, categories) => {
            if (error) return res.status(400).json({ error });
            if (categories) {
                return res.status(201).json({ categories });
            }
        })
});

router.get('/category/getspecialcategory', (req, res) => {
  Category.find({})
      .exec((error, categories) => {
          if (error) return res.status(400).json({ error });
          if (categories) {
              return res.status(201).json({ categories });
          }
      })
});

router.post('/category/getcategoryById', (req, res) => {
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

    Category.findById(catId)
        .exec((error, categories) => {
            if (error) return res.status(400).json({ error });
            if (categories) {
                // const categoryList = createCategories(categories);
                // const cat = categories;
                return res.status(201).json({ categories });
            }
        })
});

router.post('/category/delete', async (req, res) => {
    const { _id } = req.body;
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
    const deleteCategory = await Category.findOneAndDelete();
    // res.json(deleteCategory);
    // return;
    if (deleteCategory) {
        res.status(201).json({ message: 'Category deleted Successfully' });
    } else {
        res.status(400).json({ message: 'Something wrong in Category deletion' });
    }

});


// router.post('/category/update', upload.array('categoryImage'), updateCategories);
// router.post('/category/delete', deleteCategories);

module.exports = router;