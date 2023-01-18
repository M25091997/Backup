const mongoose = require("mongoose");

const contactSchema = new mongoose.Schema({
  email: {
    type: String,
    required: true,
    unique: true,
  },
  message: {
    type: String,
  },
  feedback: {
    type: String,
  },
  comment: {
    type: String,
  }
},{timestamps: true});

module.exports = mongoose.model("Contact", contactSchema);
