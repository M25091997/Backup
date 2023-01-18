const mongoose = require('mongoose');

const votebannerSchema = new mongoose.Schema({
    votebanner: { 
        type: String, 
        required:true 
    }
}, { timestamps: true });

module.exports = mongoose.model('Votebanner', votebannerSchema);