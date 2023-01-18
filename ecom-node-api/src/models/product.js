const mongoose = require('mongoose');

const productSchema = new mongoose.Schema({
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
        trim: true
    },
    numberOfLikes: {
        type: Number,
        default: 0,
      },
    numberOfDisLikes: {
        type: Number,
        default: 0,
      },
    sortprice: {
      type: Number,
      default: 0
    },
    votes: [
        {
          user: {
            type: mongoose.Schema.ObjectId,
            ref: "User",
            required: true,
          },
          isVote: {
            type: Boolean,
            default: false,
          }
        },
      ],
    attributes: [
        {
            colorId: { type: mongoose.Schema.Types.ObjectId, ref: 'ColorAttr' },
            colorName: String,
            price: String,
            mrp: String,
            stock: String
        }
    ],
    sizes: [
        {
            sizeId: { type: mongoose.Schema.Types.ObjectId, ref: 'SizeAttr' },
        }
    ],
    featurePhoto: { type: String },
    productPictures: [
        { img: { type: String} }
    ],
    reviews: [
        {
            userId: { type: mongoose.Schema.Types.ObjectId, ref: 'User', required: true },
            rating: {
                type: String,
                required: true,
              },
            review: {
                type: String,
                required: true,
              },
            commentAt: {
                type: Date,
                default: Date.now,
              }
        }
    ],
    category: {
        type: mongoose.Schema.Types.ObjectId, ref: 'Category', 
        required: true
    },
    subcategory: {
        type: mongoose.Schema.Types.ObjectId, ref: 'Subcategory',
        required: true
    },
    specialcategory: {
        type: mongoose.Schema.Types.ObjectId, ref: 'SpecialCategory',
        required: true
    },
    createdBy: {
        type: mongoose.Schema.Types.ObjectId, ref: 'User',
        required: true
    },
    isNewProduct: {
        type: Boolean,
        default: false,
      },
    isTrend: {
        type: Boolean,
        default: false,
    },
    isClearance: {
      type: Boolean,
      default: false,
  }
    
}, {timestamps: true});

module.exports = mongoose.model('Product', productSchema);