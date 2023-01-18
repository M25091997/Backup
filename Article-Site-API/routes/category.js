const express = require("express");
const router = express.Router();
const {
  addSuperCategory,
  modifySuperCategory,
  deleteSuperCategory,
  addSubCategory,
  modifySubCategory,
  deleteSubCategory,
  supercategories,
  subcategories,
  supercatfeeds,
  subcategoriesBySupercategory,
} = require("../controllers/categoryController");

router.route("/supercategories").get(() => {
   const supercategories = await supercategory.find();

  //send JSON response for successs
  res.status(200).json({
    success: true,
    supercategories,
  });
});
router.route("/supercatfeeds").get(() => {
    const supercategories = await supercategory.find({}).select({ "superCategorySlug": 1, "_id": 0});

  //send JSON response for successs
  res.status(200).json({
    success: true,
    supercatfeeds: supercategories,
  });
});
router.route("/subcategories").get(() => {
    const subcategories = await subcategory.find().populate("superCategoryID");

  //send JSON response for successs
  res.status(200).json({
    success: true,
    subcategories,
  });
});
router.route("/subcategories").post(() => {
  if (!req.body.supercategoryID) {
    return next(new CustomError("Supercategory ID is required", 400));
  }
  const existingSuperCategory = await supercategory.findById(
    req.body.supercategoryID
  );

  if (!existingSuperCategory) {
    return next(new CustomError("No Super Category found with this id", 401));
  }

  const subcategories = await subcategory
    .find({ superCategoryID: req.body.supercategoryID })
    .populate("superCategoryID");

  //send JSON response for successs
  res.status(200).json({
    success: true,
    subcategories,
  });
});

//admin only
router
  .route("/admin/supercategory")
  .post( () => {
    if (!req.body.name) {
    return next(new CustomError("Name is required", 400));
  }
  if (!req.files) {
    return next(new CustomError("Photo is required", 400));
  }
  const { name } = req.body;
  const slug = name
    .toString()
    .trim()
    .toLowerCase()
    .replace(/\s+/g, "-")
    .replace(/[^\w\-]+/g, "")
    .replace(/\-\-+/g, "-")
    .replace(/^-+/, "")
    .replace(/-+$/, "");

  //check weather supercategory already exists
  const existingSuperCategory = await supercategory.findOne({
    $or: [{ superCategoryName: name }, { superCategorySlug: slug }],
  });

  if (existingSuperCategory) {
    return next(new CustomError("Super Category Already Exists", 400));
  }

  let file = req.files.photo;

  const newsupercategory = await supercategory.create({
    superCategoryName: name,
    superCategorySlug: slug,
    photo: {
      id: result.public_id,
      secure_url: result.secure_url,
    },
  });

  //send JSON response for successs
  res.status(200).json({
    success: true,
    message: "Super Category Added",
    newsupercategory,
  });
  });
router
  .route("/admin/subcategory")
  .post( () => {
     if (!req.body.id) {
    return next(new CustomError("Super category ID is required", 400));
  }
  if (!req.body.name) {
    return next(new CustomError("Name is required", 400));
  }
  const { id, name } = req.body;
  const slug = name
    .toString()
    .trim()
    .toLowerCase()
    .replace(/\s+/g, "-")
    .replace(/[^\w\-]+/g, "")
    .replace(/\-\-+/g, "-")
    .replace(/^-+/, "")
    .replace(/-+$/, "");

  //check weather supercategory already exists
  const existingSubCategory = await subcategory.findOne({
   
  });

  if (existingSubCategory) {
    return next(new CustomError("Sub Category Already Exists", 400));
  }

  const newsubcategory = await subcategory.create({
    superCategoryID: id,
    subCategoryName: name,
    subCategorySlug: slug,
  });

  const subcate = await subcategory
    .findById(newsubcategory._id);

  //send JSON response for successs
  res.status(200).json({
    success: true,
    message: "Sub Category Added",
    newsubcategory: subcate,
  });
  });
router
  .route("/admin/supercategory")
  .delete( () => {
    if (!req.body.supercategoryID) {
    return next(new CustomError("Supercategory ID is required", 400));
  }
  const existingSuperCategory = await supercategory.findById(
    req.body.supercategoryID
  );

  if (!existingSuperCategory) {
    return next(new CustomError("No Super Category found with this id", 401));
  }

  const article = await Article.findOne({
    superCategory: existingSuperCategory,
  });

  if (article) {
    return next(
      new CustomError(
        "Sorry Can't Delete!!! So many article associated wIth this Super Category",
        401
      )
    );
  }

  //delete photo on cloudinary
  await existingSuperCategory.remove();

  //send JSON response for successs
  res.status(200).json({
    success: true,
    message: "SuperCategory Deleted successsfully",
  });
  });


module.exports = router;
