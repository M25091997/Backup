const mongoose = require('mongoose');

const aboutusSchema = new mongoose.Schema({
    name: {
        type: String,
        required: true,
        trim: true
    },
    description: {
        type: String,
        required: true,
        unique: true
    },


}, { timestamps: true });

module.exports = mongoose.model('Aboutus', aboutusSchema);