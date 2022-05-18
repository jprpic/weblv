const User = require("../model/user");

exports.users = (req, res) => {
    User.find({},{id:1, username:1})
        .then((users)=>{
            return res.status(200).send(users)
        })
        .catch(err => {
            console.log(err);
            return res.send({message: 'Something went wrong!'});
        })
}