const mongoose = require("mongoose");

const articleSchema = new mongoose.Schema({
  title: {
    type: String,
    required: [true, "Please provide a Article Title"],
    unique: true,
  },
  title_slug: {
    type: String,
    required: [true, "Please provide a Article Title Slug"],
    unique: true,
  },
  topStoryPhoto: {
    id: {
      type: String,
      required: true,
    },
    secure_url: {
      type: String,
      required: true,
    },
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
  video: {
    id: {
      type: String,
    },
    secure_url: {
      type: String,
    },
  },
  isVideoInsideArticle: {
    type: String,
    required: true,
    default: "false",
  },
  writtenBy: {
    type: mongoose.Schema.ObjectId,
    ref: "User",
    required: true,
  },
  content: {
    type: String,
    required: true,
  },
  numberOfComments: {
    type: Number,
    default: 0,
  },
  comments: [
    {
      user: {
        type: mongoose.Schema.ObjectId,
        ref: "User",
        required: true,
      },
      name: {
        type: String,
        required: true,
      },
      avatar: {
        type: String,
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
  superCategory: {
    type: mongoose.Schema.ObjectId,
    ref: "Supercategory",
    required: true,
  },
  subCategory: {
    type: mongoose.Schema.ObjectId,
    ref: "Subcategory",
    required: true,
  },
  ott: {
    type: mongoose.Schema.ObjectId,
    ref: "ottPlatform",
    required: true,
  },
  topStory: {
    type: Boolean,
    default: false,
  },
  trendThisWeek: {
    type: Boolean,
    default: false,
  },
  keywords: {
    type: String,
    required: [true, "Please provide a Article keyword"],
  },
  keywords_slug: {
    type: String,
    required: [true, "Please provide a Article keyword"],
  },
  status: {
    type: String,
    required: true,
    default: "drafting",
  },
  rejectedMessage: {
    type: String,
  },
  updatedAt: {
    type: Date,
    default: Date.now,
  },
});

articleSchema.pre("save", function (next) {
  this.updatedAt = Date.now();
  next();
});
module.exports = mongoose.model("Article", articleSchema);
