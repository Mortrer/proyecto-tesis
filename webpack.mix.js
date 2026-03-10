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

// module.exports = {
//     // ...
//     externals: {
//         // only define the dependencies you are NOT using as externals!
//         canvg: "canvg",
//         html2canvas: "html2canvas",
//         dompurify: "dompurify"
//     }
// };

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();

mix.autoload({
    jQuery: ['$', 'window.$', 'window.jQuery']
});