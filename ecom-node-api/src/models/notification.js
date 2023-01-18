const mongoose = require('mongoose');

const notificationSchema = new mongoose.Schema({
    name: {
        type: String,
        required: true,
        trim: true
    },
    description: {
        type: String,
        required: true
    },

    notificationImage: { type: String }

}, { timestamps: true });

module.exports = mongoose.model('Notification', notificationSchema);