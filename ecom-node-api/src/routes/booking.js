const express = require('express');
const mongoose = require('mongoose');

const Booking = require('../models/booking');

const { requireSignin, userMiddleware } = require('../common-middleware');
const { addBooking, getBooking, getBookingDetail, updateSlider, deleteSlider } = require('../controller/booking');
const shortid = require('shortid');
const path = require('path');
const router = express.Router();

router.post('/booking/create', requireSignin, userMiddleware, addBooking);
// router.post('/slider/update', requireSignin, upload.single('sliderImage'), async (req, res) => {

//     const { _id, name } = req.body;
//     const slider = {
//         name,
//         slug: `${slugify(req.body.name)}-${shortid.generate()}`
//     }
//     if (req.file) {
//         // slider.sliderImage = process.env.API + '/public/slider/' + req.file.filename;
//         slider.sliderImage = result.secure_url;

//     }
//     // console.log(slider);
//     // return;
//     const updatedSlider = await Slider.findOneAndUpdate({ _id: _id }, slider, { new: true });
//     return res.status(201).json({ updatedSlider: updatedSlider });
// });

router.post('/booking/getbooking', () => {
  const userId = req.body.user_id;
  const bookingItems =  Booking.find({ user: userId });
     
  if(bookingItems){
          return res.status(201).json({
              status: 200,
              bookingItems
          });
      }else{
          return res.status(201).json({
              status: 400
          });
      }

});
router.post('/booking/getbookingDetail', () => {
  const bookingId = req.body.booking_id;
  // console.log(bookingId);
  // return;
  
  const bookingItems =  Booking.find({_id : bookingId});
      const wallet_discount = 0;
      const delivery = 0;
      const referal_discount = 0;
      var resultPosts = bookingItems.map(function (post) {
          var tmpPost = post.toObject();
          let updatdOn = '15th May 2021-09:10 PM';
          let thankmsg = "Thanks for using spicywhips - We hope to see you again";
          // Add properties...
          tmpPost.updatedOn = updatdOn;
          tmpPost.thankmsg = thankmsg;
          tmpPost.paymentDetail = {
              "subtotal" : post.total,
              "delivery" : delivery,
          };
          return tmpPost;
      });
  
  if(bookingItems){
          return res.status(201).json({
              status: 200,
              resultPosts
          });
      }else{
          return res.status(201).json({
              status: 400
          });
      }
});

router.post('/booking/cancel', async (req, res) => {

  const { booking_id, cancel} = req.body;

  if (
      !(
        booking_id && mongoose.isValidObjectId(booking_id)
      )
    ) {
      return res.status(400).json({
        success: false,
        message: " wrong booking_id " + booking_id,
      });
    }

  const updateOrderStatus = {
      orderstatus: cancel
  }

  const updatedBooking = await Booking.findOneAndUpdate({ _id: booking_id });
  if(updatedBooking){
    return res.status(201).json({ status: 200, message : "Order Status successfully updated" });
  }else{
    return res.status(201).json({ status: 400, message : "Something Went Wrong" });
  }

  
});

router.post('/booking/ratedelivery', async (req, res) => {

    const { booking_id, user_id, deliveryRate, deliveryReview } = req.body;

    if (
        !(
          booking_id && mongoose.isValidObjectId(booking_id)
        )
      ) {
        return res.status(400).json({
          success: false,
          message: " wrong booking_id " + booking_id,
        });
      }
    
      if (
        !(
          user_id && mongoose.isValidObjectId(user_id)
        )
      ) {
        return res.status(400).json({
          success: false,
          message: " wrong user_id " + user_id,
        });
      }

    const updateRate = {
        deliveryRate: deliveryRate,
        deliveryReview: deliveryReview
    }

    const updatedBooking = await Booking.findOneAndUpdate();

    return res.status(201).json({ status: 200, message : "Delivery Rating successfully updated" });
});


router.get('/booking/getAll', requireSignin, async (req, res) => {

  const booking = await Booking.find({});
  if (!booking) {
      return res.status(200).json({
          success: false
      });
  }else{
      return res.status(201).json({
          success: true,
          booking
      }); 
  }
});


module.exports = router;