const mongoose = require('mongoose');

const bookingSchema = new mongoose.Schema({
    paymentmode: {
        type: String,
        required: true
    },
    paymentstatus: {
        type: String,
        required: true
    },
    orderstatus: {
        type: String,
        required: true
    },
    transactionid: {
        type: String,
        required: true
    },
    total: {
        type: Number,
        required: true
    },
    isGift: {
        type: Boolean,
        required: true
    },
    giftName: {
        type: String,
    },
    giftMsg: {
        type: String,
    },
    referCode: {
        type: String,
    },
    deliveryRate: {
        type: String
    },
    deliveryReview: {
        type: String
    },
    cartId: [
        {
            cartId: { type: mongoose.Schema.Types.ObjectId, ref: 'Cart' },
            productId: { type: mongoose.Schema.Types.ObjectId, ref: 'Product' }
        }
    ],
    addressId: {
        type: mongoose.Schema.Types.ObjectId, ref: 'Address',
        required: true
    },
    user: {
        type: mongoose.Schema.Types.ObjectId, ref: 'User',
        required: true
    }
    
}, {timestamps: true});

module.exports = mongoose.model('Booking', bookingSchema);