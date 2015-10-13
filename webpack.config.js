// var webpack = require('webpack');
var path = require("path");
var _ = require('lodash');

var ENV = 'development';
// var ENV = 'production';

var config = module.exports = require('./webpack/' + ENV + '.js');

config = _.merge(config, {
    context: __dirname,
    resolve: {
        modulesDirectories: ['node_modules', 'bower_components']
    },
    output: {
        path: path.join(__dirname, 'public', 'js')
    }
});