const mix = require('laravel-mix');
const NodePolyfillPlugin = require("node-polyfill-webpack-plugin")

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

mix.disableNotifications();


mix.js(['resources/js/backend.js'], 'public/js')
    .js(['resources/js/frontend.js'], 'public/js')
    .js(['resources/js/backendFiles/backend1.js'], 'public/js')
    .js(['resources/js/backendFiles/report.js'], 'public/js')
    .js(['resources/js/backendFiles/ordersLog.js'], 'public/js')
    .js(['resources/js/backendFiles/refund_request.js'], 'public/js')



.react()
    .sass('resources/sass/app.scss', 'public/css');

mix.webpackConfig({
    plugins: [
        new NodePolyfillPlugin(),
    ]
})
mix.options({ processCssUrls: false });



// mix.combine([
//         'resources/js/react.js',
//         // 'resources/assets/js/definers.js',
//         // 'resources/assets/js/tab_system.js',
//         // 'resources/assets/js/searchbox.js',
//         // 'node_modules/angular/angular.js',
//     ], 'public/js/react.js', true)
//     .react()
//     .sass('resources/sass/app.scss', 'public/css');