const mongoose = require('mongoose');

const clearancezonecategoryimageSchema = new mongoose.Schema({
    clearancezonecategoryImage: { type: String, required:true }
}, { timestamps: true });

module.exports = mongoose.model('Clearancezonecategoryimage', clearancezonecategoryimageSchema);