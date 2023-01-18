const mongoose = require('mongoose');

const cartSchema = new mongoose.Schema({
    user: {
        type: mongoose.Schema.Types.ObjectId, ref: 'User',
        required: true
    },
    product: {
        type: mongoose.Schema.Types.ObjectId, ref: 'Product',
        required: true
    },
    price: {
        type: Number,
        required: true
    },
    mrp: {
        type: Number,
        required: true
    },
    checkout: {
        type: Boolean,
        default: false
    },
    quantity: {
        type: Number,
        required: true
    },
    user_id: {
        type: String,
        required: true
    },
    attribute_id: {
        type: String,
        required: true
    },

}, { timestamps: true });

module.exports = mongoose.model('Cart', cartSchema);