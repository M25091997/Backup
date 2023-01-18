const express = require('express');
const { signup, signin, verifyotp } = require('../controller/auth');
const { requireSignin } = require('../common-middleware');
const { validateSignupRequest, isRequestValidated, validateSigninRequest } = require('../validators/auth');
const router = express.Router();
const User = require('../models/user');
const shortid = require('shortid');
const jwt = require('jsonwebtoken');
const bcrypt = require("bcrypt");

router.post('/testauth', (req, res) => {
    const pwd = req.body.password;
    const setHash = (pwd) => {
        const hashPwd = bcrypt.hashSync(pwd, 10);
        // console.log(hashPwd);
        res.status(200).json({
            token : hashPwd
        });
        // return;
    };
    setHash(pwd);

    // userSchema.virtual('password')
    // .set(function (password) {
    //     this.hash_password = bcrypt.hashSync(password, 10);
    // });

    // userSchema.methods = {
    // authenticate: async function (password) {
    //     return await bcrypt.compareSync(password, this.hash_password);
    // },
    // };
});

router.post('/testauth11', (req, res) => {
    const pwd = req.body.password;
    const hash_pwd = req.body.hash_password;
    const getHash = (pwd, hash_pwd) => {
        const hashPwd = bcrypt.compareSync(pwd, hash_pwd);
        // console.log(hashPwd);
        res.status(200).json({
            token : hashPwd
        });
        // return;
    };
    getHash(pwd, hash_pwd);
});




router.post('/signin', validateSigninRequest, isRequestValidated, (req, res) => {
    User.findOne({ email: req.body.email })
        .exec((error, user) => {
            if (error) return res.status(400).json({ error });
            if (user) {
                if (user.authenticate(req.body.password)) {
                    const token = jwt.sign({ _id: user._id, role: user.role }, process.env.JWT_SECRET, { expiresIn: "1d" });
                    const { _id, firstName, lastName, email, role, fullName } = user;
                    res.status(200).json({
                        token,
                        user: {
                            _id, firstName, lastName, email, role, fullName
                        }
                    });
                } else {
                    return res.status(400).json({
                        message: 'Invalid Password'
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

            let random_otp = Math.floor(100000 + Math.random() * 900000);
            const {
                firstName,
                phone,
                email,
                password
            } = req.body;
            const _user = new User({
                firstName,
                phone,
                email,
                password,
                otp : random_otp,
                username: shortid.generate(),
                role: 'user'
            });

            _user.save((error, data) => {
                if (error) {
                    return res.status(200).json({
                        message: 'Something went wrong',
                        status: 400
                    });
                }

                if (data) {
                    return res.status(200).json({
                        msg: 'User Created Succesfully',
                        status: 200,
                        result: data
                    })
                }
            })
        });

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


router.post('/profile', requireSignin ,(req, res) => {
    res.status(200).json({ user: 'profile'});
})

module.exports = router;