const mongoose = require('mongoose');

const faqsuperquestionSchema = new mongoose.Schema({
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


}, { timestamps: true });

module.exports = mongoose.model('Faqsuperquestion', faqsuperquestionSchema);