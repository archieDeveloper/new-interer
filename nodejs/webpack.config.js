var path, webpack;

path    = require('path');
webpack = require('webpack');

module.exports = {
  entry: './source/js/admin.js',
  output: {
    path: path.join(__dirname, '../js/'),
    filename: 'admin.js'
  },
  resolve: {
    root: path.resolve(__dirname, './source/js'),
    extensions: ['', '.js']
  },
  plugins: [
    new webpack.optimize.UglifyJsPlugin
  ]
};