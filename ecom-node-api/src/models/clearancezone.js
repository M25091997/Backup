const mongoose = require('mongoose');

const clearancezoneSchema = new mongoose.Schema({
    name: {
        type: String,
        required: true,
        trim: true
    },
    description: {
        type: String,
        required: true
    },

    clearancezoneImage: { type: String }

}, { timestamps: true });

module.exports = mongoose.model('Clearancezone', clearancezoneSchema);