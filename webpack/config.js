var webpack = require("webpack");
var path = require("path");
var ChunkManifestPlugin = require('chunk-manifest-webpack-plugin');
var SplitByNamePlugin = require('split-by-name-webpack-plugin');

var resolveBowerPath = function(componentPath) {
    return path.join(__dirname, '../bower_components', componentPath);
};

var resolveBasePath = function(componentPath) {
    return path.join(__dirname, '../webapp', componentPath);
};

var resolveViewPath = function(componentPath) {
    return path.join(__dirname, '../webapp/views', componentPath);
};

module.exports = {
    resolve: {
        extensions: ['', '.js', '.json', '.coffee', '.jsx'],
        alias: {
            // 'bootstrap': resolveBowerPath('/bootstrap/dist/js/bootstrap.js'),
            // 'pace': resolveBowerPath('/pace/pace.js'),
            // 'helpers': resolveBasePath('/common/helpers.js'),
            // 'notification': resolveBasePath('/common/notification.js'),
            // 'Player': resolveBasePath('/views/player.js'),
            // 'app': resolveBasePath('/app.js'),
            // 'auth': resolveBasePath('/auth.js'),

            // 'jquery.scrollbar': resolveBowerPath('/jquery.scrollbar/jquery.scrollbar.js'),
            // 'Locstor': resolveBowerPath('/locstor/locstor.min.js'),
            // 'lazyload': resolveBowerPath('/jquery.lazyload/jquery.lazyload.js'),
            // 'toastr': resolveBowerPath('/toastr/toastr.js'),
            // 'bLazy': resolveBowerPath('/bLazy/blazy.js'),
            // 'videojs': resolveBowerPath('/video.js/dist/video-js/video.js'),
            // 'videojs-youtube': resolveBowerPath('/videojs-youtube/dist/vjs.youtube.js'),
        }
    },
    entry: {
        app: [
            resolveBasePath('/app.js')
        ],  
        // views: [
        //  resolveViewPath('/about/view.js'),

        //  resolveViewPath('/errors/404.js'),

        //  resolveViewPath('/index/view.js'),

        //  resolveViewPath('/videos/edit.js'),
        //  resolveViewPath('/videos/show.js'),
        //  resolveViewPath('/videos/index.js'),
            
        //  resolveViewPath('/player.js'),
        //  resolveViewPath('/nav.js'),
        // ],           
        vendor: [
            // "backbone",
            // "backbone-deep-model",
            "jquery",
            // "underscore",
            // "backbone-react-component",
            "react",    
            // "formsy-react",
            // 'bootstrap',
            // 'jquery.scrollbar',
            // "pace",
            // "node-waves",
            // "Locstor",
            // "moment",
            // "bLazy"
        ],       
    },
    output: {
        filename: "[name].js",
        chunkFilename: '[id].js',
        publicPath: './public/js/'
    },
    module: {
        loaders: [
            { test: /\.css$/, loader: "style!css" },
            { test: /\.js$/, loader: "jsx-loader?insertPragma=React.DOM&harmony!jstransform-loader?jsx-control-statements" }
        ]
    },
    plugins: [      
        new webpack.ResolverPlugin([
            new webpack.ResolverPlugin.DirectoryDescriptionFilePlugin('.bower.json', ['main'])
        ]),
        new webpack.optimize.AggressiveMergingPlugin(),
        new webpack.optimize.DedupePlugin(),
        new webpack.optimize.OccurenceOrderPlugin(),

        new webpack.ProvidePlugin({
            $: "jquery",
            jQuery: "jquery",
            "window.jQuery": "jquery",
        }),

        new ChunkManifestPlugin({
            filename: "manifest.json",
            manifestVariable: "webpackManifest"
        }),

        // new SplitByNamePlugin({
        //  buckets: [{
        //      name: 'vendor',
        //      regex: /vendor\//
        //  }, {
        //      name: 'views',
        //      regex: /views\//
        //  }]
        // }),
    ]
};