const express = require('express');
const mongoose = require('mongoose');

const { requireSignin, adminMiddleware } = require('../common-middleware');

const shortid = require('shortid');
const router = express.Router();
const upload = require("../../utils/multer");

const Firebasenotification = require('../models/firebasenotification');
const slugify = require('slugify');


router.post('/firebase/create', requireSignin, upload.single('firebasenotificationImage'), async (req, res) => {
    try {
        const categoryObj = {
            name: req.body.name,
            description: req.body.description
        }

        if (req.file) {
            categoryObj.isImage = true;
            categoryObj.firebasenotificationImage = result.secure_url;
        }

        const cat = new Firebasenotification(categoryObj);
        cat.save((error, firebase) => {
            if (error) return res.status(400).json({ error });
            if (firebase) {
                return res.status(201).json({ success: true, firebase });
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
        category.categoryImage = result.secure_url;

    }
    // console.log(place);
    // return;
    const updatedCategory = await Category.findOneAndUpdate({ _id: _id }, category, { new: true });
    return res.status(201).json({ status: 200, message : "Category successfully updated" });
});


// router.post('/category/upload', requireSignin, upload.single('category'), uploadCategory);

router.get('/firebase/get', (req, res) => {
    Firebasenotification.find({})
        .exec((error, notifications) => {
            if (error) return res.status(400).json({ error });
            if (notifications) {
                // const categoryList = createnotifications(notifications);
                return res.status(201).json({ notifications });
            }
        })
});

router.get('/category/getcategoryvote', (req, res) => {
    Category.find({},{slug:0,categoryImage:0,createdAt:0,updatedAt:0,__v:0})
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
    const deleteCategory = await Category.findOneAndDelete({ _id: _id });
    // res.json(deleteCategory);
    // return;
    if (deleteCategory) {
        res.status(201).json({ message: 'Category deleted Successfully' });
    } else {
        res.status(400).json({ message: 'Something wrong in Category deletion' });
    }

});



module.exports = router;