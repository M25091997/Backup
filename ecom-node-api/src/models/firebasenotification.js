const mongoose = require('mongoose');

const firebasenotificationSchema = new mongoose.Schema({
    name: {
        type: String,
        required: true,
        trim: true
    },
    description: {
        type: String,
        required: true
    },
    // firebaseToken: [
    //     {
    //         token: String
    //     }
    // ],
    isImage: {
        type: Boolean,
        default: false,
    },
    firebasenotificationImage: { type: String }

}, { timestamps: true });

module.exports = mongoose.model('Firebasenotification', firebasenotificationSchema);