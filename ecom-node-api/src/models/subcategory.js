const mongoose = require('mongoose');

const subcategorySchema = new mongoose.Schema({
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
    supercategory: {
        type: mongoose.Schema.Types.ObjectId, ref: 'Category',
        required: true
    },
    subcategoryImage: { type: String },

}, { timestamps: true });

module.exports = mongoose.model('Subcategory', subcategorySchema);