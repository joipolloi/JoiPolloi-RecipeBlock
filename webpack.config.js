const path = require('path');
const webpack = require('webpack');

// Adjust this to point at wherever Wordpress is running from locally
const buildDir = './';

config = {
    entry: './js/index.js',
    output: {
        path: path.resolve(__dirname, buildDir),
        filename: 'main.js'
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                loader: 'babel-loader',
            },
            {
            test: /\.css$/i,
            use: ['style-loader', 'css-loader'],
            },
        ]
    },
    stats: {
        colors: true
    }
};

module.exports = (env, argv) => {

    if (argv.mode === 'development') {
        config.devtool = 'source-map';
        config.watch = true;
        // config.optimization = {minimize: false};

    }

    if (argv.mode === 'production') {
        config.devtool = 'source-map';
    }

    return config;
  };