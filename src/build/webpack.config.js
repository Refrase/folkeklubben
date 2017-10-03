const path = require( 'path' );
const webpack = require( 'webpack' );
const ExtractTextPlugin = require( 'extract-text-webpack-plugin' );

module.exports = function( env = {} ) {

  if ( env.production ) process.env.NODE_ENV = 'production';

  if ( process.env.NODE_ENV == 'production' ) __webpack_public_path__ = 'http://folkeklubben.dk/dist/';

  function makeStyleLoader( type ) {
    const cssLoader = {
      loader: 'css-loader',
      options: {
        minimize: env.production
      }
    };
    const loaders = [ cssLoader ];
    if ( type )
      loaders.push( type + '-loader' );
    if ( env.production ) {
      return ExtractTextPlugin.extract( {
        use: loaders,
        fallback: 'vue-style-loader'
      } );
    } else {
      return [ 'vue-style-loader' ].concat( loaders );
    }
  }

  return {

    entry: './src/main.js',

    output: {
      path: path.resolve( __dirname, '../../dist' ),
      publicPath: env.production ? '/' : 'http://localhost:8080/',
      filename: env.production ? 'dist/main.min.js' : 'dist/main.js'
    },

    devServer: {
      contentBase: false, // Only serve files part of the bundle to run server alongside the apache server that serves WordPress
      hot: true,
      headers: {
        'Access-Control-Allow-Origin': '*'
      }
    },

    plugins: env.production ? [
      new webpack.DefinePlugin({
        'process.env': { NODE_ENV: '"production"' }
      }),
      new webpack.optimize.UglifyJsPlugin({
        compress: { warnings: false }
      }),
      new ExtractTextPlugin({
        filename: 'css/style.min.css'
      })
    ] : [
      new webpack.HotModuleReplacementPlugin()
    ],

    devtool: env.production ? false : '#cheap-module-eval-source-map',

    module: {
      rules: [
        {
          test: /\.vue$/,
          loader: 'vue-loader',
          options: {
            loaders: {
              css: makeStyleLoader(),
              sass: makeStyleLoader( 'sass' )
            }
          }
        },
        {
          test: /\.js$/,
          loader: 'babel-loader',
          exclude: /node_modules/
        },
        {
          test: /\.css$/,
          use: makeStyleLoader()
        },
        {
          test: /\.sass$/,
          use: makeStyleLoader( 'sass' )
        },
        {
          test: /\.(png|jpg)$/,
          loader: 'file-loader',
          options: {
            name: 'images/[name].[ext]'
          }
        }
      ]
    },

    resolve: {
      extensions: [ '.js', '.vue', '.json' ],
      alias: {
        '@': path.resolve( __dirname, '..' )
      }
    }

  };
};
