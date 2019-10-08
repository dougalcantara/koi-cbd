const { resolve } = require('path');

module.exports = {
  mode: process.env.NODE_ENV,
  entry: ['@babel/polyfill', './src/js/app.js'],
  output: {
    filename: 'magnetic.bundle.js',
    path: resolve(__dirname, 'dist/js'),
  },
  module: {
    rules: [
      {
        test: /\.m?js$/,
        exclude: /(node_modules|bower_components)/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env'],
          },
        },
      },
    ],
  },
};
