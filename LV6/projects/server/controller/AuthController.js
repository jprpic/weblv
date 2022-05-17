const { genPassword } = require("../database/passwordUtils");
const User = require("../model/user");

exports.login = (req, res) => {
    // if(!req.user){
    //     res.status(401).send({message: 'Unauthorized'});
    // }
    // res.cookie('session', req.user.id , { signed: true, expires: new Date(Date.now() + 3600), httpOnly: false});
    // res.status(200).json({msg:'Cookie has been set'});
    res.status(200).json({user: req.user.id, msg: 'logged in'});
}

exports.user = (req, res) => {
    console.log(req.session);
    console.log(req.user);
    if(req.isAuthenticated()){
        res.send('You are authenticated');
    }else{
        res.send('Unauthorized');
    }
}

exports.logout = (req, res) => {
    if(req.user){
        req.logout();
        res.status(200).send('You are logged out!');
    }
    else{
        res.status(401).send('Unauthorized');
    }
    
}

exports.register = (req, res) => {
    // Validate request
    if(!req.body){
        res.status(400).send({ message: "Content can not be empty!"});
        return;
    }

    const saltHash = genPassword(req.body.password);
    const newUser = new User({
        username : req.body.username,
        hash: saltHash.hash,
        salt: saltHash.salt
    })

    newUser.save()
        .then((user) => {
            res.json(user)
        })
        .catch(err => {
            res.status(500).send({ message: `Error registering user!`});
        })
}