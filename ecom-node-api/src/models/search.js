const mongoose = require('mongoose');

const searchSchema = new mongoose.Schema({
    name: {
        type: String,
        required: true,
        trim: true
    },
    slug: {
        type: String,
        required: true,
        unique: true
    }

}, { timestamps: true });

module.exports = mongoose.model('Search', searchSchema);