const mongoose = require("mongoose");
const bcrypt = require("bcrypt");

const userSchema = new mongoose.Schema(
  {
    firstName: {
      type: String,
      required: true,
      trim: true,
      min: 3,
      max: 20,
    },
    phone: {
      type: String,
      required: true,
      trim: true,
      min: 10,
      max: 10,
    },
    username: {
      type: String,
      required: true,
      trim: true,
      unique: true,
      index: true,
      lowercase: true,
    },
    gender: {
      type: String,
      required: true
    },
    firebaseToken: {
      type: String
    },
    email: {
      type: String,
      required: true,
      trim: true,
      unique: true,
      lowercase: true,
    },
    hash_password: {
      type: String,
      required: true,
    },
    otp: {
      type: Number,
      required: true,
    },
    walletamount: {
      type: Number,
      default:0
    },
     isVerified: {
      type: Boolean,
      required: true,
      default: false
    },
    role: {
      type: String,
    },
    refercode: {
      type: String,
      unique: true,
      required: true
    },
    profile_img: {
      type: String,
      required: true,
      default: "https://res.cloudinary.com/nikcloud1/image/upload/v1658833927/ecomnode/user/img_avatar_qrzqwd.png"
    },
  },
  { timestamps: true }
);

userSchema.virtual('password')
  .set(function (password) {
    this.hash_password = bcrypt.hashSync(password, 10);
  });

userSchema.virtual("fullName").get(function () {
  return `${this.firstName}`;
});

userSchema.methods = {
  authenticate: async function (password) {
    return await bcrypt.compareSync(password, this.hash_password);
  },
};

module.exports = mongoose.model("User", userSchema);
