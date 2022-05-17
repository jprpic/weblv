const express = require('express');
const passport = require('passport');
const route = express.Router();

const projectController = require('../controller/ProjectController');
const authController = require('../controller/AuthController');
const res = require('express/lib/response');


route.get('/', (req, res) => {
    console.log(req.user);
    res.send('Crud App!')
});


route.get('/api/projects', projectController.find);
route.post('/api/projects', projectController.create);
route.put('/api/projects/:id', projectController.update);
route.delete('/api/projects/:id', projectController.delete);

route.post('/api/login', passport.authenticate('local'), authController.login);
route.get('/api/user', authController.user);
route.get('/api/logout', authController.logout);
route.post('/api/register', authController.register);

module.exports = route;