const mongoose = require('mongoose');

const paymenthistorySchema = new mongoose.Schema({
    paymentmode: {
        type: String,
        required: true
    },
    amount: {
        type: String,
        required: true
    },
    transactionid: {
        type: String,
        required: true
    },
    processid: {
        type: String,
        required: true,
        unique: true
    },
    booking: {
        type: mongoose.Schema.Types.ObjectId, ref: 'Booking',
        required: true
    }
    
}, {timestamps: true});

module.exports = mongoose.model('Paymenthistory', paymenthistorySchema);