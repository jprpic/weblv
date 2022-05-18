const passport = require('passport');
const LocalStrategy = require('passport-local').Strategy;
const connection = require('./connection');
const User = require('../model/user');
const { validatePassword } = require('./passwordUtils');

const verifyCallback = (username, password, done) => {
    User.findOne({username : username})
        .then((user) => {
            if(!user) { return done(null, false)}

            const isValid = validatePassword(password, user.hash, user.salt);

            if(isValid){
                return done(null, user)
            }
            else{
                return done(null, false)
            }
        }).catch((err) => {
            done(err);
        })
}

passport.use(new LocalStrategy(verifyCallback));

// passport.serializeUser((user, done) => {
//     done(null, { id: user.id, username: user.username } )
// });

// passport.deserializeUser((userId, done) => {
//     User.findById(userId)
//         .then((user) => {
//             done(null, user)
//         })
//         .catch(err => done(err))
// });

passport.serializeUser(function(user, done) {
    process.nextTick(function() {
      console.log('serializeUser');
      console.log(user);
      done(null, { _id: user.id, username: user.username });
    });
  });

  passport.deserializeUser(function(userId, done) {
    process.nextTick(function() {
      console.log('deserializeUser');
      console.log(userId);
      User.findById(userId)
        .then((user) => {
            done(null, user)
        })
        .catch(err => done(err))
    });
  });