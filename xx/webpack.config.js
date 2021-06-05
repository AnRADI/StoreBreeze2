const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const RemovePlugin = require('remove-files-webpack-plugin');
const CopyPlugin = require("copy-webpack-plugin");
const ImageMinimizerPlugin = require('image-minimizer-webpack-plugin');
const { VueLoaderPlugin } = require('vue-loader');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const webpack = require('webpack');


var myMode = process.env.NODE_ENV;


module.exports = {

    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
            '@': path.resolve('./resources/js'),
        },
    },

    mode: myMode,
    performance: {
        maxEntrypointSize: 512000,
        maxAssetSize: 512000
    },
    devServer: {
        //historyApiFallback: true,
        //contentBase: path.join(__dirname, './'),
        //contentBase: path.resolve(__dirname, './public'),
        // watchContentBase: true,

        //open: true,
        writeToDisk: true,
        noInfo: true,
        clientLogLevel: 'silent',
        host: 'store',
        proxy: {
            '/': 'http://store',
        },

        // compress: true,
        //hot: true,
    },
    devtool: myMode === 'development' ? 'source-map' : false,

    entry: {
        main: path.resolve(__dirname, './resources/js/app.js'),
    },
    output: {
        path: path.resolve(__dirname, './public'),
        filename: 'js/app.js',
        // hotUpdateChunkFilename: 'hot/hot-update.js',
        // hotUpdateMainFilename: 'hot/hot-update.json'
    },


    plugins: [

        new VueLoaderPlugin(),

        new webpack.DefinePlugin({
            __VUE_OPTIONS_API__: true,
            __VUE_PROD_DEVTOOLS__: false,
        }),

        new BrowserSyncPlugin(
            {
                proxy: 'store',
                host: 'store',
                notify: false,
                open: 'external',
                files: [
                    {
                        match: [
                            '**/*.php'
                        ],
                        fn: function(event, file) {
                            if (event === "change") {
                                const bs = require('browser-sync').get('bs-webpack-plugin');
                                bs.reload();
                            }
                        }
                    }
                ]
            },
            {
                reload: false
            }),

        new MiniCssExtractPlugin({
            filename: 'css/app.css',
        }),

        new RemovePlugin({
            // watch: {
            //     test: [
            //         {
            //             folder: './public',
            //             method: () => true
            //         }
            //     ],
            //     exclude: [
            //         './public/favicon.ico',
            //         './public/index.php',
            //         './public/.htaccess',
            //         './public/mix-manifest.json',
            //         './public/robots.txt',
            //         './public/favicon.ico',
            //         './public/web.config',
            //         './public/vendor',
            //         './public/js',
            //         './public/css',
            //         './public/img'
            //     ]
            // },
            before: {
                test: [
                    {
                        folder: './public',
                        method: () => true
                    }
                ],
                exclude: [
                    './public/favicon.ico',
                    './public/index.php',
                    './public/.htaccess',
                    './public/mix-manifest.json',
                    './public/robots.txt',
                    './public/favicon.ico',
                    './public/web.config',
                    './public/vendor',
                    './public/storage',
                ]
            },
        }),

        myMode !== 'development' ? new ImageMinimizerPlugin({
            minimizerOptions: {
                plugins: [
                    ['gifsicle', { interlaced: true }],
                    ['mozjpeg', { quality: 75 }],
                    ['optipng', { optimizationLevel: 5 }],
                    [
                        'svgo',
                        {
                            plugins: [
                                {
                                    removeViewBox: true,
                                },
                            ],
                        },
                    ],
                ],
            },
        }) : null,

        new CopyPlugin({
            patterns: [
                {
                    from: './resources/img',
                    to: './img',
                    noErrorOnMissing: true
                },
            ],
        }),
    ].filter(Boolean),


    module: {
        rules: [
            {
                test: /\.vue$/,
                use: ['vue-loader'],

            },
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: ['babel-loader'],
            },
            {
                test: /\.(scss|css)$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    {
                        loader: "css-loader",
                        options: {
                            url: false,
                        },
                    },
                    myMode === 'development' ? {
                        loader: "sass-loader",
                        options: {
                            sassOptions: {
                                outputStyle: "expanded",
                            },
                        },
                    } : 'sass-loader',
                ],
            },
            {
                test: /\.(jpe?g|png|gif|svg)$/i,
                type: 'asset',
            },

        ],
    },


};

