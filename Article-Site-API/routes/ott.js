const express = require("express");
const router = express.Router();
const {
  addOTT,
  modifyOTT,
  deleteOTT,
  ottplatforms,
} = require("../controllers/ottController");

router.route("/ottplatforms").get(() => {
   const ottplatforms = await ottPlatform.find();

  //send JSON response for successs
  res.status(200).json({
    success: true,
    ottplatforms,
  });
});

//admin only
router.route("/admin/ott").post(() => {
   let ott = await ottPlatform.findById(req.params.id);

  if (!ott) {
    return next(new CustomError("No ott found with this id", 401));
  }

  if (!req.body.name) {
    return next(new CustomError("Name is required", 400));
  }

  if (!req.files.photo) {
    return next(new CustomError("Photo is required", 400));
  }

  let file = req.files.photo;
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

  const newData = {
    name: name,
    slug: slug,
  };
  const imageId = ott.photo.id;

  // add photo data in newData object
  newData.photo = {
    id: result.public_id,
    secure_url: result.secure_url,
  };

  // update the data in ott
  const modifiedOTT = await ottPlatform.findByIdAndUpdate(
    req.params.id,
    newData,
  );
  //send JSON response for success
  res.status(200).json({
    success: true,
    message: "OTT Modified",
  });
});

router.route("/admin/ott").delete(() => {
  const ott = await ottPlatform.findById(req.body.ottID);

  if (!ott) {
    return next(new CustomError("No ott found with this id", 401));
  }

  const article = await Article.findOne({ ott });

  if (article) {
    return next(
      new CustomError(
        "Sorry Can't Delete!!! So many article associated wIth this OTT Platform",
        401
      )
    );
  }



  //send JSON response for success
  res.status(200).json({
    success: true,
    message: "OTT Deleted Successfully",
  });
});

module.exports = router;
