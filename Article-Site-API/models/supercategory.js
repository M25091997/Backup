const mongoose = require("mongoose");

const categorySchema = new mongoose.Schema({
  superCategoryName: {
    type: String,
    required: [true, "Please provide a Super Category Name"],
    unique: true,
  },
  superCategorySlug: {
    type: String,
    required: true,
    unique: true,
  },
  photo: {
    id: {
      type: String,
      required: true,
    },
    secure_url: {
      type: String,
      required: true,
    },
  },
});

module.exports = mongoose.model("Supercategory", categorySchema);
