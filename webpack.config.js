const path = require('path');
const webpack = require('webpack');

module.exports = {

    resolve: {
        alias: {
            '@': path.resolve('resources/js'),
        },
        // fallback: {
        //     fs: false,
        //     crypto: false
        // },
    },

    plugins: [
        new webpack.DefinePlugin({
            __VUE_OPTIONS_API__: true,
            __VUE_PROD_DEVTOOLS__: false,
        }),
    ]

};
