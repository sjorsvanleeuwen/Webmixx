let mix = require('laravel-mix');

mix.setResourceRoot("/vendor/webmixx/");

mix.js('resources/assets/js/app.js', 'dist/js/webmixx.js')
    .setPublicPath('dist')
    .vue()
    .extract(['vue', 'vuex', 'lodash', 'axios']);

mix.sass('resources/assets/scss/app.scss', 'dist/css/webmixx.css')
    .setPublicPath('dist');
