const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
let production = mix.inProduction();

mix.js('resources/js/app.js', 'public/js').vue()
    .sass('resources/sass/app.scss', 'public/css')
    .webpackConfig(require('./webpack.config'))
    .sourceMaps(!production, 'source-map')
    .disableNotifications()
    .browserSync({
        proxy: 'store-breeze2',
        host: 'store-breeze2',
        notify: false,
        open: 'external'
    });

if (production) {
    mix.version();
}

