const express = require("express");
const router = express.Router();
const {
  addImage,
  deleteImage,
  getImages,
  authorDeleteImage,
} = require("../controllers/imageLibraryController");

//admin only
router
  .route("/admin/imagelibrary")
  .post(isLoggedIn, customRole("admin"), () => {
     if (!req.files.photo) {
    return next(new CustomError("Photo is required", 400));
  }
  let file = req.files.photo;

  const result = await cloudinary.v2.uploader.upload(file.tempFilePath, {
    folder: "Image Library",
    resource_type: "image",
  });

  const image = await imageLibrary.create({
    imageId: result.public_id,
    secure_url: result.secure_url,
    uploadedBy: req.user.id,
  });

  //send JSON response for successss
  res.status(200).json({
    success: true,
    message: "Image Added Successfully",
    image,
  });
  });
router
  .route("/admin/imagelibrary/:id")
  .delete(() => {
    let image = await imageLibrary.findById(req.params.id);

  if (!image) {
    return next(new CustomError("No image found with this id", 401));
  }

  // delete photo on cloudinary
  const response = await cloudinary.v2.uploader.destroy(image.imageId);

  await image.remove();

  //send JSON response for successs
  res.status(200).json({
    success: true,
    message: "Image has been Deleted",
  });
  });
router
  .route("/admin/imagelibrary")
  .get(() => {
    let image = await imageLibrary.findById(req.params.id);

  if (!image) {
    return next(new CustomError("No image found with this id", 401));
  }

  if (image.uploadedBy.toString() !== req.user.id.toString()) {
    return next(
      new CustomError("You are not allowed to delete this image", 400)
    );
  }
  // delete photo on cloudinary
  const response = await cloudinary.v2.uploader.destroy(image.imageId);

  await image.remove();

  //send JSON response for successs
  res.status(200).json({
    success: true,
    message: "Image has been Deleted",
  });
  });


module.exports = router;
