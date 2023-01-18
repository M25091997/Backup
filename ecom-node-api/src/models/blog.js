const mongoose = require('mongoose');

const blogSchema = new mongoose.Schema({
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
    detail: {
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
    comments: [
        {
          user: {
            type: mongoose.Schema.ObjectId,
            ref: "User",
            required: true,
          },
          comment: {
            type: String,
            required: true,
          },
          commentAt: {
            type: Date,
            default: Date.now,
          },
        },
      ],
    // blogPictures: [
    //     { img: { type: String } }
    // ],
    blogThumbnail: { type: String },
    // blogImage: { type: String },
    createdBy: {
        type: mongoose.Schema.Types.ObjectId, ref: 'User',
        required: true
    }
}, { timestamps: true });

module.exports = mongoose.model('blog', blogSchema);