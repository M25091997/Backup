const mongoose = require('mongoose');

const faqsubquestionSchema = new mongoose.Schema({
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
    faqsuperId: {
        type: mongoose.Schema.Types.ObjectId, ref: 'Faqsuperquestion',
        required: true
    },


}, { timestamps: true });

module.exports = mongoose.model('Faqsubquestion', faqsubquestionSchema);