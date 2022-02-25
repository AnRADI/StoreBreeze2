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

mix.setPublicPath('public_html/');

mix.js('resources/js/app.js', 'public_html/js').vue()
    .copy('resources/images', 'public_html/images')
    .sass('resources/sass/app.scss', 'public_html/css').options({
        processCssUrls: false
    })
    .webpackConfig(require('./webpack.config'))
    .sourceMaps(!production, 'source-map')
    .disableNotifications()
    .browserSync({
        proxy: 'praktiww.beget.tech.local',
        host: 'praktiww.beget.tech.local',
        notify: false,
        open: 'external',
    });

if (production) {
    mix.version(['public_html/images']);
    //mix.version(['public/images', 'public/Admin/**/*.{js,css,png,jpg,gif,svg}']);
}