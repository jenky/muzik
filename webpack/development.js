var webpack = require('webpack');
var _ = require('lodash');
var config = module.exports = require('./config.js');

config = _.merge(config, {
    debug: true,
    outputPathinfo: true,
    devtool: 'source-map',
});

config.plugins.push(
    new webpack.optimize.CommonsChunkPlugin("vendor", "vendor.js", Infinity)
);