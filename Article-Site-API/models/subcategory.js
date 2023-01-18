const mongoose = require("mongoose");

const subCategorySchema = new mongoose.Schema({
  superCategoryID: {
    type: mongoose.Schema.ObjectId,
    ref: "Supercategory",
    required: true,
  },
  subCategoryName: {
    type: String,
    required: [true, "Please provide a Sub Category Name"],
    //TODO: Manually check if Subcategory should not repeat in case of same supercategory. We can have drama inside both supercategory i.e. Hollywood and Bollywood but we cannot have drama and drama inside Bollywood
  },
  subCategorySlug: {
    type: String,
    required: true,
    //TODO: Manually check if Subcategory should not repeat in case of same supercategory. We can have drama inside both supercategory i.e. Hollywood and Bollywood but we cannot have drama and drama inside Bollywood
  },
});

module.exports = mongoose.model("Subcategory", subCategorySchema);
