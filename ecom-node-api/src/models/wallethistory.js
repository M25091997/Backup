const mongoose = require('mongoose');

const wallethistorySchema = new mongoose.Schema({
    user: {
        type: mongoose.Schema.Types.ObjectId, ref: 'User',
        required: true
    },
    transmsg: {
        type: String,
        required: true
    },
    transcode: {
        type: String,
        required: true
    },
    transamount: {
        type: Number,
        required: true
    }

}, { timestamps: true });

module.exports = mongoose.model('Wallethistory', wallethistorySchema);