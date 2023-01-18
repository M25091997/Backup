const mongoose = require('mongoose');

const orderSchema = new mongoose.Schema({
    processid: {
        type: String,
        required: true,
        unique: true
    },
    cart: {
        type: mongoose.Schema.Types.ObjectId, ref: 'Cart',
        required: true
    }
    
}, {timestamps: true});

module.exports = mongoose.model('Order', orderSchema);