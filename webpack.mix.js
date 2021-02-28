let mix = require('laravel-mix');

mix.setResourceRoot("/vendor/webmixx/");

mix.js('resources/assets/js/app.js', 'dist/js/webmixx.js')
    .setPublicPath('dist')
    .vue()
    .extract([
        '@ckeditor',
        'axios',
        'css-loader',
        'ckeditor5-classic-plus',
        'lodash',
        'process',
        'sortablejs',
        'style-loader',
        'vue',
        'vue-loader',
        'vuedraggable',
        'vuex',
    ])
    .sourceMaps();

mix.sass('resources/assets/scss/app.scss', 'dist/css/webmixx.css')
    .setPublicPath('dist');
