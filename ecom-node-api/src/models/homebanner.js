const mongoose = require('mongoose');

const homebannerSchema = new mongoose.Schema({
    homebanner: { 
        type: String, 
        required:true 
    }
}, { timestamps: true });

module.exports = mongoose.model('Homebanner', homebannerSchema);