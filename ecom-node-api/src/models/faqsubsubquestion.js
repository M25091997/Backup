const mongoose = require('mongoose');

const faqsubsubquestionSchema = new mongoose.Schema({
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
    faqsubId: {
        type: mongoose.Schema.Types.ObjectId, ref: 'Faqsubquestion',
        required: true
    },


}, { timestamps: true });

module.exports = mongoose.model('Faqsubsubquestion', faqsubsubquestionSchema);