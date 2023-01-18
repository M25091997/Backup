const mongoose = require('mongoose');

const sliderSchema = new mongoose.Schema({
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

    sliderImage: { type: String }

}, { timestamps: true });

module.exports = mongoose.model('Slider', sliderSchema);