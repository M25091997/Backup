const mongoose = require("mongoose");

const ottPlatformSchema = new mongoose.Schema({
  name: {
    type: String,
    required: [true, "Please provide a OTT Platform Name"],
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
  slug: {
    type: String,
    required: true,
    unique: true,
  },
});

module.exports = mongoose.model("ottPlatform", ottPlatformSchema);
