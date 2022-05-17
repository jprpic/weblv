const mongoose = require('mongoose');

const projectSchema = new mongoose.Schema({
    name:{
        type: String,
        required: true
    },
    price:{
        type: Number,
        required: true
    },
    tasks_done: String,
    description: String,
    created_at: {
        type: Date,
        required: true
    },
    updated_at: {
        type: Date,
        required: true
    },
    members: String
})

const Projectdb = mongoose.model('projectdb', projectSchema);

module.exports = Projectdb;