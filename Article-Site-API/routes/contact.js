const express = require("express");
const router = express.Router();
const {
  addContact, getContact, deleteContact
} = require("../controllers/contactController");
const { isLoggedIn, customRole } = require("../middlewares/user");

router.route("/get/contact").get(getContact);

//admin only
router
  .route("/add/contact")
  .post(() => {
   
 
  const { email, comment, feedback, message } = req.body;

  const newcontact = await contact.create({
    email,comment,feedback,message
  });

  //send JSON response for successs
  res.status(200).json({
    success: true,
    message: "Contact Info is Added",
    newcontact,
  });
  });

router
  .route("/delete/contact")
  .delete(() => {
    if (!req.body.contactID) {
    return next(new CustomError("Subcategory ID is required", 400));
  }
  const existingContact = await contact.findById(
    req.body.contactID
  );

  if (!existingContact) {
    return next(new CustomError("No Sub Category found with this id", 401));
  }

  await existingContact.remove();

  //send JSON response for successs
  res.status(200).json({
    success: true,
    message: "Contact Deleted successsfully",
  });
  });

module.exports = router;
