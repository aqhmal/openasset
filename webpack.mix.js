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

mix.js('resources/assets/js/app.js', 'public/js/asset_list.js')
   .js('resources/assets/js/category_list.js', 'public/js/category_list.js')
   .js('resources/assets/js/user_list.js', 'public/js/user_list.js')
   .js('resources/assets/js/asset_user_list.js', 'public/js/asset_user_list.js')
   .js('resources/assets/js/category_user_list.js', 'public/js/category_user_list.js')
   .js('resources/assets/js/borrow_list.js', 'public/js/borrow_user_list.js')
   .js('resources/assets/js/borrow_admin_list.js', 'public/js/borrow_list.js');