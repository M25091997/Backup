const mongoose = require('mongoose');

const commercialvideoSchema = new mongoose.Schema({
    name: {
        type: String,
        required: true,
        trim: true
    },
    slug: {
        type: String,
        required: true,
        unique: true
    },
    description: {
        type: String,
        required: true,
        trim: true
    },
    numberOfLikes: {
      type: Number,
      default: 0,
    },
    likes: [
        {
          user: {
            type: mongoose.Schema.ObjectId,
            ref: "User",
            required: true,
          },
          isLike: {
            type: Boolean,
            default: false,
          }
        },
      ],
    commercialImage: { type: String },
    commercialVideo: { type: String }

}, { timestamps: true });

module.exports = mongoose.model('Commercialvideo', commercialvideoSchema);