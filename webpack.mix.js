const mix = require('laravel-mix');
mix.options({
    fileLoaderDirs: {
        fonts: 'assets/font',
        images: 'assets/img'
    }
});
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/assets/js')
    .js('resources/js/script.js', 'public/assets/js')
    .postCss('resources/css/app.css', 'public/assets/css')
    .postCss('resources/css/style.css', 'public/assets/css')
    .version();
