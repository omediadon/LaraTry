const mix = require("laravel-mix");
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

mix.js("resources/js/app.js", "public/js")
   .extract(["jquery",
             "bootstrap",
             "moment",
             "moment-timezone"])
   .version()
   .sourceMaps();

mix.sass("resources/sass/app.scss", "public/css")
   .version()
   .sourceMaps();

mix.copyDirectory("resources/images", "public/img");
