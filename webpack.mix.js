let mix = require('laravel-mix');

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

mix.js('resources/assets/admin/js/app.js', 'public/js')
   .js('resources/assets/site/js/site.js', 'public/js')
   .js('resources/assets/site/js/departmentsMap.js', 'public/js/site')
        .minify('public/js/site/departmentsMap.js')
   .sass('resources/assets/admin/sass/app.scss', 'public/css');
