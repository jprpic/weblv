const express = require('express');
const route = express.Router;

route.get('/', (req, res) => {
    res.send('Crud App!')
});

module.exports = route;