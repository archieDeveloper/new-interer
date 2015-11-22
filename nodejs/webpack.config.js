var path, webpack;

path    = require('path');
webpack = require('webpack');

module.exports = {
  entry: './source/js/admin/index.js',
  output: {
    path: path.join(__dirname, '../js/')
  },
  filename: 'admin',
  module: {
    loaders: [
      {test: /\.coffee$/, loader: 'coffee-loader'}
    ]
  },
  resolve: {
    extensions: ["", ".web.coffee", ".web.js", ".coffee", ".js"]
  },
  plugins: [
    new webpack.optimize.UglifyJsPlugin
  ]
};