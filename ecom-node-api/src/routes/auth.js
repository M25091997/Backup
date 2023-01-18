const express = require('express');
const mongoose = require('mongoose');
const { signup, signin, verifyotp, userByID, updateUserToken, updateUserByID } = require('../controller/auth');
const { requireSignin } = require('../common-middleware');
const { validateSignupRequest, isRequestValidated, validateSigninRequest } = require('../validators/auth');
const router = express.Router();
const User = require('../models/user');
const Product = require('../models/product');
const Booking = require('../models/booking');
const Category = require('../models/category');

const Promo = require('../models/promo');
const shortid = require('shortid');
const jwt = require('jsonwebtoken');
const bcrypt = require("bcrypt");
const upload = require("../../utils/multer");
const cloudinary = require("../../utils/cloudinary");




router.post('/resetpassword', (req, res) => {
    User.findOne({ phone: req.body.phone })
        .exec((error, user) => {
            if (error) return res.status(400).json({ error });
            if (user) {
                return res.status(200).json({
                    otp: user.otp,
                    status: 200
                })
            } else {
                return res.status(400).json({ message: 'Something Went wrong', status: 400 });
            }
        });
});

router.post('/verifyotp', (req, res) => {
    User.findOne({ phone: req.body.phone })
        .exec((error, user) => {
            if (error) return res.status(400).json({ error });
            if (user) {
                if(user.otp == req.body.otp){
                    return res.status(200).json({
                        status: 200,
                        user_id: user._id
                    })
                }else{
                    return res.status(200).json({
                        messge: "OTP not matched",
                        status: 400
                    })
                }
            } else {
                return res.status(400).json({ message: 'Something went wrong', status: 400 });
            }
        });
});

router.post('/updatepassword', async (req, res) => {
    const user_id = req.body.user_id;
    const password = req.body.password;
    const newpwd = bcrypt.hashSync(password, 10);

    await User.findByIdAndUpdate(
        user_id,
        {
            $set: { hash_password: newpwd },
        },
        { new: true }
    ).exec((err, result) => {
        if (err) {
            console.log(err);
        } else {
            res.status(200).json({
                message: 'Password Updated Succesfully',
                status: 200,
                user: result,
            });
        }

    });
});

router.post('/user/changePassword', async (req, res) => {
    const user_id = req.body.user_id;
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
    
    const user = await User.findOne({ _id: user_id });
    if(!user){
        return res.status(400).json({
            success: false,
            message: "User not exist",
          });
    }else{
        const hashPwd = bcrypt.compareSync(req.body.password, user.hash_password);
        if(!hashPwd){
            return res.status(400).json({
                success: false,
                message: "Password is wrong",
              });
        }
    }

    // return;
    
    const newpassword = req.body.newpassword;
    const newpwd = bcrypt.hashSync(newpassword, 10);

    await User.findByIdAndUpdate(
        user_id,
        {
            $set: { hash_password: newpwd },
        },
        { new: true }
    ).exec((err, result) => {
        if (err) {
            console.log(err);
        } else {
            res.status(200).json({
                message: 'Password Changed Succesfully',
                success: true
            });
        }

    });
});

router.post('/user/changeMobileSendOtp', async (req, res) => {
    const user_id = req.body.user_id;
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

    const user = await User.findOne({ _id: user_id });
    if (!user) {
        return res.status(400).json({
            success: false,
            message: "User not exist",
        });
    }else{
        const hashPwd = bcrypt.compareSync(req.body.password, user.hash_password);
        if(!hashPwd){
            return res.status(400).json({
                success: false,
                message: "Password is wrong",
              });
        }
    } 

    // return1;
    let random_otp = Math.floor(100000 + Math.random() * 900000);

    await User.findByIdAndUpdate(
        user_id,
        {
            $set: { otp: random_otp },
        },
        { new: true }
    ).exec((err, result) => {
        if (err) {
            console.log(err);
        } else {
            res.status(200).json({
                message: 'Otp sent Succesfully',
                status: 200,
                otp: random_otp
            });
        }

    });
});

router.post('/user/changeMobile', async (req, res) => {
    const user_id = req.body.user_id;
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

    const user = await User.findOne({ _id: user_id, otp: req.body.otp });
    if (!user) {
        return res.status(400).json({
            success: false,
            message: "User not exist or otp is wrong",
        });
    }

    // return;

    await User.findByIdAndUpdate(
        user_id,
        {
            $set: { phone: req.body.phone },
        },
        { new: true }
    ).exec((err, result) => {
        if (err) {
            console.log(err);
        } else {
            res.status(200).json({
                message: 'Phone No Changed Succesfully',
                status: 200
            });
        }

    });
});


router.post('/signin', validateSigninRequest, isRequestValidated, (req, res) => {
    User.findOne({ email: req.body.email })
        .exec((error, user) => {
            if (error) return res.status(400).json({ error });
            if (user) {
                const hashPwd = bcrypt.compareSync(req.body.password, user.hash_password);
                if (hashPwd) {
                    const token = jwt.sign({ _id: user._id, role: user.role }, process.env.JWT_SECRET, { expiresIn: "1d" });
                    const { _id, firstName, lastName, email, role, fullName } = user;
                    res.status(200).json({
                        msg: 'User LoggedIn Succesfully',
                        status: 200,
                        token,
                        user: {
                            _id, firstName, lastName, email, role, fullName
                        }
                    });
                } else {
                    return res.status(200).json({
                        message: 'Invalid Password',
                        status: 400
                    })
                }

            } else {
                return res.status(400).json({ message: 'Something went wrong' });
            }
        });
});

router.post('/signup', validateSignupRequest, isRequestValidated, (req, res) => {
    User.findOne({ phone: req.body.phone })
        .exec((error, user) => {

            if (user) {
                if (user.isVerified == false) {
                    User.findByIdAndDelete(user._id, function (err) {
                        if (err) console.log(err);
                        console.log("Successful deletion");
                    });
                }
            }

            function randomString(length, chars) {
                var result = '';
                for (var i = length; i > 0; --i) result += chars[Math.floor(Math.random() * chars.length)];
                return result;
            }
            var refercode = randomString(8, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');

            let random_otp = Math.floor(100000 + Math.random() * 900000);
            const {
                firstName,
                phone,
                gender,
                email,
                password
            } = req.body;
            const _user = new User({
                firstName,
                phone,
                gender,
                email,
                password,
                otp : random_otp,
                username: shortid.generate(),
                role: 'user',
                refercode
            });

            _user.save((error, data) => {
                if (error) {
                    return res.status(200).json({
                        message: 'Something went wrong',
                        status: 400
                    });
                }

                if (data) {
                    const token = jwt.sign({ _id: data._id, role: data.role }, process.env.JWT_SECRET, { expiresIn: "1d" });
                    return res.status(200).json({
                        msg: 'User Created Succesfully',
                        status: 200,
                        token,
                        result: data
                    })
                }
            })
        });

});

router.post('/user/userdetail', userByID);
router.post('/user/update', updateUserByID);
router.post('/user/registertoken', updateUserToken);


router.post('/user/profileImgUpdate', requireSignin, upload.single('thumbnail'), async (req, res) => {

    const { user_id } = req.body;
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

    const result = await cloudinary.uploader.upload(req.file.path, { folder: 'ecomnode/user' });
    let pro_img = '';
    if (req.file) {
        pro_img = result.secure_url;
    }
    const updateImg = {
        profile_img: pro_img
    }

    const updatedCategory = await User.findOneAndUpdate({ _id: user_id }, updateImg, { new: true });
    return res.status(201).json({ status: 200, message : "Profile Img successfully updated" });
});


router.post('/verify', async (req, res) => {
    const user_id = req.body.user_id;
    const otp = req.body.otp;

    var query = User.find({
        $and: [{ _id: user_id }, { otp: otp }],
    });
    query.count(function (err, count) {
        if (err) console.log(err)
        else {
            if (count != 1) {
                res.status(200).json({
                    message: 'OTP not matched',
                    status: 400
                });

            }
        }
    });

    await User.findByIdAndUpdate(
        user_id,
        {
            $set: { isVerified: true },
        },
        { new: true }
    ).exec((err, result) => {
        if (err) {
            console.log(err);
        } else {
            res.status(200).json({
                message: 'User Verified Succesfully',
                status: 200,
                user: result,
            });
        }

    });

});


router.post('/user/checkReferCode', async (req, res) => {

    const user = await User.findOne({ refercode: req.body.refercode });
    if (!user) {
        return res.status(200).json({
            success: false,
            message: "Invalid ReferCode",
        });
    }else{
        return res.status(201).json({
            success: true,
            referamount:100,
            message: "ReferCode Applied Successfully",
        }); 
    }
});

router.post('/user/checkPromoCode', async (req, res) => {

    const promo = await Promo.findOne({ promocode: req.body.promocode });
    if (!promo) {
        return res.status(200).json({
            success: false,
            message: "Invalid PromoCode",
        });
    }else{
        return res.status(201).json({
            success: true,
            promoamount:100,
            message: "PromoCode Applied Successfully",
        }); 
    }
});

router.get('/user/getAll',requireSignin, async (req, res) => {

    const user = await User.find({});
    if (!user) {
        return res.status(200).json({
            success: false
        });
    }else{
        return res.status(201).json({
            success: true,
            user
        }); 
    }
});

router.get('/user/dashboard/count',requireSignin, async (req, res) => {

    const user = await User.countDocuments();
    const product = await Product.countDocuments({});
    const booking = await Booking.countDocuments({});
    const category = await Category.countDocuments({});
    const userMale = await User.countDocuments({gender:"male"});
    const userFemale = await User.countDocuments({gender:"female"});

    const malepercent = (userMale/user)*100;
    const femalepercent = (userFemale/user)*100;
    const popularProduct = await Product.find({isTrend: true},{subcategory:0,attributes:0,sizes:0}).populate('category',['name']);
    const newProduct = await Product.find({isNewProduct: true},{category:0,subcategory:0,attributes:0,sizes:0});

    const recentorder = await Booking.find({}).sort({updatedAt: -1}).populate('cartId.productId',['name','description','sortprice','productPictures']);

    if (!user && !product && !booking && !category) {
        return res.status(200).json({
            success: false
        });
    }else{
        return res.status(201).json({
            success: true,
            user,
            malepercent,
            femalepercent,
            product,
            booking,
            category,
            recentorder,
            popularProduct,
            newProduct
        }); 
    }
});


router.post('/profile', requireSignin ,(req, res) => {
    res.status(200).json({ user: 'profile'});
})

module.exports = router;