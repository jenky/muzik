var webpack = require('webpack');
var _ = require('lodash');
var config = module.exports = require('./config.js');

config = _.merge(config.output, {
    filename: "[name]-[chunkhash].js",
    chunkFilename: '[id]-[chunkhash].js',
});

config.plugins.push(
    new webpack.optimize.CommonsChunkPlugin("vendor", "vendor-[chunkhash].js", Infinity),
    new webpack.optimize.UglifyJsPlugin()
);