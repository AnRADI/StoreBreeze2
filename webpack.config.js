const path = require('path');
const webpack = require('webpack');

module.exports = {

    resolve: {
        alias: {
            '@': path.resolve('resources/js'),
            '~': path.resolve('node_modules'),
            'resources/lang': path.resolve('resources/lang'),
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
        })
    ]

};
