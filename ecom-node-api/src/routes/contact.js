const express = require('express');
const mongoose = require('mongoose');

const { requireSignin, adminMiddleware } = require('../common-middleware');
// const { addCategory, getCategories, updateCategory, deleteCategory } = require('../controller/category');
const shortid = require('shortid');
const router = express.Router();

const Contact = require('../models/contact');
const slugify = require('slugify');


router.post('/contact/create', async (req, res) => {
    try {

        const categoryObj = {
            name: req.body.name,
            email: req.body.email,
            phone: req.body.phone,
            message: req.body.message
        }

        const cat = new Contact(categoryObj);
        cat.save((error, contact) => {
            if (error) return res.status(201).json({ status:200, msg:"Something went wrong" });
            if (contact) {
                return res.status(201).json({ status:200, msg:"Contact Added Successfully" });
            }
        });
    }
    catch (err) {
        console.log(err);
    }
});

router.post('/contact/update', requireSignin, async (req, res) => {

    const { contact_id, name } = req.body;
    if (
        !(
          contact_id && mongoose.isValidObjectId(contact_id)
        )
      ) {
        return res.status(400).json({
          success: false,
          message: " wrong contact_id ",
        });
      }

    const Contactobj = {
        name: req.body.name,
        email: req.body.email,
        phone: req.body.phone,
        message: req.body.message
    }
  
    const updatedContact = await Contact.findOneAndUpdate({ _id: contact_id }, Contactobj, { new: true });
    if(updatedContact){
        return res.status(201).json({ status: 200, msg: "Contact Added Successfully" });
    }else{
        return res.status(201).json({ status: 200, msg: "Something went wrong" });
    }
});

// router.post('/contact/getsizeById', (req, res) => {
//     const catId = req.body.size_id;
//     if (
//         !(
//           catId && mongoose.isValidObjectId(catId)
//         )
//       ) {
//         return res.status(400).json({
//           success: false,
//           message: " wrong size_id ",
//         });
//       }

//       SizeAttr.findById(catId)
//         .exec((error, sizes) => {
//             if (error) return res.status(400).json({ error });
//             if (sizes) {
//                 return res.status(201).json({ sizes });
//             }
//         })
// });

router.get('/contact/get', (req, res) => {
    Contact.find({})
        .exec((error, contact) => {
            if (error) return res.status(400).json({ error });
            if (contact) {
                return res.status(201).json({ contact });
            }
        })
});

router.post('/contact/delete', async (req, res) => {
    const { _id } = req.body;
    if (
        !(
          _id && mongoose.isValidObjectId(_id)
        )
      ) {
        return res.status(400).json({
          success: false,
          message: " wrong contact_id ",
        });
      }

    const contact = await Contact.findOneAndDelete({ _id: _id });
    
    if (contact) {
        res.status(201).json({ message: 'Contact deleted Successfully' });
    } else {
        res.status(400).json({ message: 'Something wrong in Contact deletion' });
    }

});

module.exports = router;