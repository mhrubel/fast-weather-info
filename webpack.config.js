const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const TerserJSPlugin = require('terser-webpack-plugin');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const ESLintPlugin = require('eslint-webpack-plugin');

const devMode = process.env.NODE_ENV !== 'production';

// Determine output directory based on the mode
const outputDir = devMode ? 'build-development' : 'build-production';

module.exports = {
  entry: {
    frontend: './src/frontend/main.js',
    admin: './src/admin/main.js',
    style: './src/assets/less/style.less',
  },
  mode: devMode ? 'development' : 'production',
  output: {
    path: path.resolve(__dirname, outputDir),
    filename: devMode ? 'src/assets/js/[name].js' : 'src/assets/js/[name].min.js',
  },
  resolve: {
    alias: {
      'vue$': 'vue/dist/vue.esm-bundler.js', // For Vue 3
      'frontend': path.resolve('./src/frontend/'),
      'admin': path.resolve('./src/admin/'),
    },
    modules: [
      path.resolve('./node_modules'),
      path.resolve('./src/'),
    ],
  },
  optimization: {
    minimize: !devMode,
    minimizer: [
      new TerserJSPlugin(),
      new CssMinimizerPlugin(),
    ],
    runtimeChunk: 'single',
    splitChunks: {
      cacheGroups: {
        vendor: {
          test: /[\\\/]node_modules[\\\/]/,
          name: 'vendors',
          chunks: 'all',
        },
      },
    },
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: devMode ? 'src/assets/css/[name].css' : 'src/assets/css/[name].min.css',
    }),
    new CopyWebpackPlugin({
      patterns: [
        { from: '.', to: '' },
        { from: 'vendor', to: 'vendor' },
        { from: 'languages', to: 'languages' },
        { from: 'app', to: 'app' },
      ],
    }),
    new ESLintPlugin({
      context: path.resolve(__dirname, 'src'),
      extensions: ['js', 'vue'],
      exclude: 'node_modules',
    }),
  ],
  module: {
    rules: [
      {
        test: /\.vue$/,
        loader: 'vue-loader',
      },
      {
        test: /\.js$/,
        use: 'babel-loader',
        exclude: /node_modules/,
      },
      {
        test: /\.less$/,
        use: [
          MiniCssExtractPlugin.loader,
          'css-loader',
          'less-loader',
        ],
      },
      {
        test: /\.(png|svg)$/,
        type: 'asset/resource',
      },
      {
        test: /\.css$/,
        use: [
          MiniCssExtractPlugin.loader,
          'css-loader',
        ],
      },
    ],
  },
  watchOptions: {
    ignored: /node_modules/,
  },
};
