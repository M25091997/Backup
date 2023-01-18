const express = require('express');
const { requireSignin, adminMiddleware } = require('../common-middleware');
// const { addSubCategory, getAllCategories, getSubCategoriesBySupercatId, deleteSubCategory, updateSubCategory } = require('../controller/subcategory');
const multer = require('multer');
const shortid = require('shortid');
const path = require('path');
const router = express.Router();
const upload = require("../../utils/multer");

const Subcategory = require('../models/subcategory');
const Category = require('../models/category');

const slugify = require('slugify');
const cloudinary = require("../../utils/cloudinary");


// const storage = multer.diskStorage({
//     destination: function (req, file, cb) {
//         cb(null, path.join(path.dirname(__dirname), 'uploads'))
//     },
//     filename: function (req, file, cb) {
//         cb(null, shortid.generate() + '-' + file.originalname)
//     }
// });

// const upload = multer({ storage });

// router.post('/category/create', requireSignin, adminMiddleware, upload.single('categoryImage'), addCategory);

router.post('/subcategory/create', requireSignin, upload.single('subcategoryImage'), async (req, res) => {
    const result = await cloudinary.uploader.upload(req.file.path, { folder: 'ecomnode/subcat' });

    const categoryObj = {
        name: req.body.name,
        slug: `${slugify(req.body.name)}-${shortid.generate()}`
    }

    if (req.file) {
        // categoryObj.subcategoryImage = process.env.API + '/public/' + req.file.filename;
        categoryObj.subcategoryImage = result.secure_url;
    }

    if (req.body.supercategory) {
        categoryObj.supercategory = req.body.supercategory;
    }

    const cat = new Subcategory(categoryObj);
    cat.save((error, category) => {
        if (error) return res.status(400).json({ error });
        if (category) {
            return res.status(201).json({ category });
        }
    });
});

router.get('/subcategory/get', async (req, res) => {
    const results = await Subcategory.aggregate([
        { $group: { _id: "$supercategory", subcategory: { $push: "$$ROOT" } } },
    ]);
    const finalresult = results.map(function (doc) {
        doc.supercategory = doc._id;
        delete doc._id;
        return new Subcategory(doc);
    });
    const finalresulttwo = await Category.populate(results, {
        path: "supercategory",
    });
    //send JSON response for successs
    res.status(200).json({
        successs: true,
        result: finalresulttwo,
    });
});


router.post('/subcategory/get/supercategory/', async (req, res) => {
    let supercategoryId = req.body.supercategoryId;
    if (supercategoryId == "") {
        res.status(400).json({
            successs: false,
            result: "Supercat Id is Required",
        });
    }
    const subcats = await Subcategory.find({ supercategory: supercategoryId });
    //send JSON response for successs
    res.status(200).json({
        successs: true,
        result: subcats,
    });
});

router.post('/subcategory/getById/', async (req, res) => {
    let subcategoryId = req.body.subcategoryId;
    if (subcategoryId == "") {
        res.status(400).json({
            successs: false,
            result: "Supercat Id is Required",
        });
    }
    const subcats = await Subcategory.find({ _id: subcategoryId });
    //send JSON response for successs
    res.status(200).json({
        successs: true,
        result: subcats,
    });
});




// router.get('/subcategory/getsubcategory', getCategories);

router.post('/subcategory/update', upload.single('subcategoryImage'), async (req, res) => {

    const result = await cloudinary.uploader.upload(req.file.path, { folder: 'ecomnode/subcat' });

    const { _id, name, super_id } = req.body;
    const category = {
        name,
        supercategory: super_id,
        slug: `${slugify(req.body.name)}-${shortid.generate()}`,
    }

    if (req.file) {
        // category.categoryImage = process.env.API + '/public/super-category/' + req.file.filename;
        category.subcategoryImage = result.secure_url;

    }
    // console.log(place);
    // return;
    const updatedCategory = await Subcategory.findOneAndUpdate({ _id: _id }, category, { new: true });
    return res.status(201).json({ updatedCategory: updatedCategory });
});


router.post('/subcategory/delete', async (req, res) => {
    const { _id } = req.body;
    // res.json(_id);
    // return;
    const deleteCategory = await Subcategory.findOneAndDelete({ _id: _id });
    // res.json(deleteCategory);
    // return;
    if (deleteCategory) {
        res.status(201).json({ message: 'SubCategory deleted Successfully' });
    } else {
        res.status(400).json({ message: 'Something wrong in Category deletion' });
    }

});

module.exports = router;