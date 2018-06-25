const path = require( 'path' );
const webpack = require( 'webpack' );
const ExtractTextPlugin = require( 'extract-text-webpack-plugin' );
const FileManagerPlugin = require( 'filemanager-webpack-plugin' );

module.exports = function( env = {} ) {

  if ( env.production ) process.env.NODE_ENV = 'production';

  if ( process.env.NODE_ENV == 'production' ) __webpack_public_path__ = 'http://www.folkeklubben.dk/wp-content/themes/folkeklubben/dist/';

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

    entry: ['babel-polyfill', './src/main.js'],

    output: {
      path: path.resolve( __dirname, './dist' ),
      filename: env.production ? 'js/main.min.js' : 'js/main.js',
      publicPath: env.production ? __webpack_public_path__ : 'http://localhost:8080/wp-content/themes/folkeklubben/'
    },

    // About combining webpack-dev-server and (in this project) MAMP server: https://webpack.github.io/docs/webpack-dev-server.html#combining-with-an-existing-server
    devServer: {
      proxy: {
        '/': {
          target: 'http://localhost:3000',
          secure: false
        }
      },
      inline: true,
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
      }),
      new FileManagerPlugin({
        onStart: {
          delete: [ path.resolve( __dirname, './dist/assets' ) ]
        },
        onEnd: {
          copy: [
            {
              source: path.resolve( __dirname, './src/assets' ),
              destination: path.resolve( __dirname, './dist/assets' )
            }
          ]
        }
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
            },
            postcss: [require('autoprefixer')()]
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
          test: /\.s[a|c]ss$/,
          use: makeStyleLoader( 'sass' )
        },
        {
          test: /\.(png|jpg|gif|svg)$/,
          loader: 'file-loader',
          options: {
            name: 'assets/images/[name].[ext]'
          }
        },
        {
          test: /\.(woff|woff2|otf)(\?v=[0-9]\.[0-9]\.[0-9])?$/,
          loader: 'url-loader',
          options: {
            name: 'assets/fonts/[name].[ext]'
          }
        }
      ]
    },

    resolve: {
      extensions: [ '.js', '.vue', '.json', '.scss' ],
      alias: {
        '@': path.resolve( __dirname, 'src/' ),
        'vue$': 'vue/dist/vue.esm.js'
      }
    }

  };
};
