const mongoose = require("mongoose");

const imageLibrarySchema = new mongoose.Schema({
  imageId: {
    type: String,
    required: true,
    unique: true,
  },
  secure_url: {
    type: String,
    required: true,
    unique: true,
  },
  uploadedBy: {
    type: mongoose.Schema.ObjectId,
    ref: "User",
    required: true,
  },
  uploadedAt: {
    type: Date,
    default: Date.now,
  },
});

module.exports = mongoose.model("imageLibrary", imageLibrarySchema);
