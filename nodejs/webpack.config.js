var path, webpack;

path    = require('path');
webpack = require('webpack');

module.exports = {
  entry: './source/js/admin.js',
  output: {
    path: path.join(__dirname, '../js/'),
    filename: 'admin.js'
  },
  module: {
    loaders: [ {
      test: /\.tpl$|.smarty$/,
      loader: 'smarty'
    } ]
  },
  resolve: {
    root: [
      path.resolve(__dirname, './source/js'),
      path.resolve(__dirname, '../application/views')
    ],
    extensions: ['', '.js']
  },
  plugins: [
    new webpack.optimize.UglifyJsPlugin
  ]
};