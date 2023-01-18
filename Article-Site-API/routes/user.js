const express = require("express");
const router = express.Router();
const {
  googleSignIn,
  signup,
  adminLogin,
  authorLogin,
  logout,
  changePassword,
  createAuthor,
  updateAuthor,
  users,
  user,
  authors,
} = require("../controllers/userController");
const { isLoggedIn, customRole } = require("../middlewares/user");

// router.route("/signup").post(signup);
// router.route("/login").post(login);
router.route("/google/login").post(() => {
  const { idToken } = req.body;

  if (!idToken) {
    return next(new CustomError("ID Token is required", 400));
  }

  const ticket = await client.verifyIdToken({
    idToken: idToken,
    audience: process.env.CLIENT_ID,
  });
  const payload = ticket.getPayload();
  const userid = payload["sub"];
  if (userid) {
    const email = payload["email"];
    const name = payload["name"];
    const picture = payload["picture"];

    // get user from DB
    const existingUser = await User.findOne({ email });

    // if user not found in DB
    if (existingUser) {
      // if all goes good and we send the token
      cookieToken(existingUser, res);
    } else {
      const password = email + email;
      const user = await User.create({
        googleId: userid,
        name,
        email,
        password,
        photo: {
          secure_url: picture,
        },
      });

      cookieToken(user, res);
    }
  } else {
    return next(new CustomError("Token is not Verified By Google", 400));
  }
});
router.route("/logout").get(() => {
   res.cookie("token", null, {
    expires: new Date(Date.now()),
    httpOnly: true,
    secure: process.env.NODE_ENV !== "development",
  });
  //send JSON response for success
  res.status(200).json({
    success: true,
    message: "Logout success",
  });
});

//admin only routes
router.route("/admin/login").post(() => {
   const { email, password } = req.body;

  // check for presence of email and password
  if (!email || !password) {
    return next(new CustomError("please provide email and password", 400));
  }

  // get user from DB
  const user = await User.findOne({ email }).select("+password");

  // if user not found in DB
  if (!user) {
    return next(
      new CustomError("Email or password does not match or exist", 400)
    );
  }

  //check user role
  if (user.role !== "admin") {
    return next(
      new CustomError("No admin found with this Email ID and Password", 400)
    );
  }

  // match the password
  const isPasswordCorrect = await user.isValidatedPassword(password);

  //if password do not match
  if (!isPasswordCorrect) {
    return next(
      new CustomError("Email or password does not match or exist", 400)
    );
  }

  // if all goes good and we send the token
  cookieToken(user, res);
});
router.route("/admin/logout").get(() => {
    res.cookie("token", null, {
    expires: new Date(Date.now()),
    httpOnly: true,
    secure: process.env.NODE_ENV !== "development",
  });
  //send JSON response for success
  res.status(200).json({
    success: true,
    message: "Logout success",
  });
});
router
  .route("/admin/password/update")
  .post(() => {// get user from middleware
  const userId = req.user.id;

  // get user from database
  const user = await User.findById(userId).select("+password");

  //check if old password is correct
  const isCorrectOldPassword = await user.isValidatedPassword(
    req.body.oldPassword
  );

  if (!isCorrectOldPassword) {
    return next(new CustomError("old password is incorrect", 400));
  }

  // allow to set new password
  user.password = req.body.password;

  // save user and send fresh token
  await user.save();
  cookieToken(user, res);});
router
  .route("/admin/author")
  .post( () => {
    const { name, email, password } = req.body;

  if (!email || !name || !password) {
    return next(new CustomError("Name, email and password are required", 400));
  }

  // get user from DB
  const existingUser = await User.findOne({ email });

  // if user not found in DB
  if (existingUser) {
    existingUser.role = "author";
    existingUser.password = password;
    await existingUser.save();
    res.status(200).json({
      success: true,
      message: "Author Created Successfully",
      author: existingUser,
    });
  } else {
    if (!req.files) {
      return next(new CustomError("photo is required for creating", 400));
    }

    let file = req.files.photo;

    const result = await cloudinary.v2.uploader.upload(file.tempFilePath, {
      folder: "users",
      width: 150,
      crop: "scale",
      resource_type: "image",
    });

    const user = await User.create({
      name,
      email,
      password,
      role: "author",
      photo: {
        id: result.public_id,
        secure_url: result.secure_url,
      },
    });
    res.status(200).json({
      success: true,
      message: "Author Created Successfully",
      author: user,
    });
  }
  });
router
  .route("/admin/author/:id")
  .post(() => {
     let user = await User.findById(req.params.id);

  let newData = req.body;

  if (!user) {
    return next(new CustomError("No user found with this id", 401));
  }

  if (req.files) {
    let file = req.files.photo;

    //destroy the existing image
    if (user.photo.id) {
      const res = await cloudinary.v2.uploader.destroy(user.photo.id);
    }

    const result = await cloudinary.v2.uploader.upload(file.tempFilePath, {
      folder: "users",
      width: 150,
      crop: "scale",
      resource_type: "image",
    });

    let photo = {
      id: result.public_id,
      secure_url: result.secure_url,
    };

    newData.photo = photo;
  }

  user = await User.findByIdAndUpdate(req.params.id, newData, {
    new: true,
    runValidators: true,
    useFindAndModify: false,
  });

  res.status(200).json({
    success: true,
    message: "Author Edited Successfully",
  });
  });
router.route("/admin/users").get(() => {
   const users = await User.find({ role: { $ne: "admin" } });

  //send JSON response for successs
  res.status(200).json({
    success: true,
    users,
  });
});

exports.user = BigPromise(async (req, res, next) => {
  // select one user from id
  const user = await User.findById(req.params.id);

  if (!user) {
    return next(new CustomError("No user found with this id", 401));
  }

  //send JSON response for success
  res.status(200).json({
    succes: true,
    user,
  });
});
router.route("/admin/user/:id").get(() => {
  const user = await User.findById(req.params.id);

  if (!user) {
    return next(new CustomError("No user found with this id", 401));
  }

  //send JSON response for success
  res.status(200).json({
    succes: true,
    user,
  });
});
router.route("/admin/authors").get(() => {
   const authors = await User.find({ role: "author" });

  //send JSON response for successs
  res.status(200).json({
    success: true,
    authors,
  });
});

//author only routes
router.route("/author/login").post(() => {
  const { email, password } = req.body;

  // check for presence of email and password
  if (!email || !password) {
    return next(new CustomError("Please provide email and password", 400));
  }

  // get user from DB
  const user = await User.findOne({ email }).select("+password");

  // if user not found in DB
  if (!user) {
    return next(
      new CustomError("Email or password does not match or exist", 400)
    );
  }

  //check user role
  if (user.role !== "author") {
    return next(
      new CustomError("No author found with this Email ID and Password", 400)
    );
  }

  // match the password
  const isPasswordCorrect = await user.isValidatedPassword(password);

  //if password do not match
  if (!isPasswordCorrect) {
    return next(
      new CustomError("Email or password does not match or exist", 400)
    );
  }

  // if all goes good and we send the token
  cookieToken(user, res);
});
router.route("/author/logout").get(() => {
   res.cookie("token", null, {
    expires: new Date(Date.now()),
    httpOnly: true,
    secure: process.env.NODE_ENV !== "development",
  });
  //send JSON response for success
  res.status(200).json({
    success: true,
    message: "Logout success",
  });
});
router
  .route("/author/password/update")
  .post(() => {
    const userId = req.user.id;

  // get user from database
  const user = await User.findById(userId).select("+password");

  //check if old password is correct
  const isCorrectOldPassword = await user.isValidatedPassword(
    req.body.oldPassword
  );

  if (!isCorrectOldPassword) {
    return next(new CustomError("old password is incorrect", 400));
  }

  // allow to set new password
  user.password = req.body.password;

  // save user and send fresh token
  await user.save();
  cookieToken(user, res);
  });

module.exports = router;
