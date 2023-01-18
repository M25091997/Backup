const mongoose = require('mongoose');

const faqsubanswerSchema = new mongoose.Schema({
    answer: {
        type: String,
        required: true,
        trim: true
    },
    faqsubId: {
        type: mongoose.Schema.Types.ObjectId, ref: 'Faqsubsubquestion',
        required: true
    },
}, { timestamps: true });

module.exports = mongoose.model('Faqsubanswer', faqsubanswerSchema);