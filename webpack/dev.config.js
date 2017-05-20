const webpack = require('webpack');
const path = require('path');
const WriteFilePlugin = require('write-file-webpack-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin')

const theme = 'jeffersonrise';

// define src & dist directories
const srcDir = path.resolve(__dirname, '../src/');
const buildDir = path.resolve(__dirname, '../wordpress/wp-content/themes/' + theme);

// dev server config
const serverConfig = {
    host: 'localhost',
    scheme: 'http',
    port: 3001,
    url: function () {
        return this['scheme'] + '://' + this['host'] + ':' + this['port'];
    }
};

// base dev webpack config
module.exports = {
    cache: true,
    devtool: 'source-map',
    stats: 'errors-only',
    entry: srcDir + '/js/index.js',
    output: {
        path: buildDir,
        filename: 'bundle.js',
        publicPath: serverConfig.url() + '/dist/'
    },
    devServer: {
        hot: true,
        stats: 'errors-only',
        clientLogLevel: 'none',
        contentBase: buildDir,
        publicPath: serverConfig.url() + '/dist/',
        https: serverConfig.scheme == 'https',
        port: serverConfig.port,
        headers: {
            'Access-Control-Allow-Origin': 'http://localhost:9000',
        }
    },
    module : {
        loaders : [
            {
                test: /\.js$/,
                include: srcDir,
                loaders: ['babel-loader?cacheDirectory=true']
            },
            {
                test: /\.(scss|css)$/,
                include: srcDir,
                loaders: ['style-loader', 'css-loader?sourceMap', 'resolve-url-loader', 'sass-loader?sourceMap']
            },
            {
                test: /\.(png|jpg|gif|svg|eot|woff|ttf)$/,
                include: srcDir,
                loaders: ['url-loader']
            }
        ]
    },
    plugins: [
        new webpack.NamedModulesPlugin(),
        new webpack.HotModuleReplacementPlugin(),
        new WriteFilePlugin(),
        new CopyWebpackPlugin([{ from: srcDir, to: buildDir }], { ignore: ['js/**/*', 'scss/**/*'] })
    ]
};