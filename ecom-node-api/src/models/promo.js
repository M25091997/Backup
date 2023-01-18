const mongoose = require('mongoose');

const promoSchema = new mongoose.Schema({
    title: {
        type: String,
        required: true,
        trim: true
    },
    description: {
        type: String,
        required: true
    },
    promocode:{
        type: String,
        required: true,
        unique: true
    },
    status: {
        type: Boolean,
        default: true
      }
}, { timestamps: true });

module.exports = mongoose.model('Promo', promoSchema);