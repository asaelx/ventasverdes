const elixir = require('laravel-elixir');
require('laravel-elixir-livereload');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {
    mix
    .sass([
        './node_modules/spectre.css/dist/spectre.min.css',
        './node_modules/spectre.css/dist/spectre-exp.min.css',
        './node_modules/typicons.font/src/font/typicons.css',
        './node_modules/select2/dist/css/select2.min.css',
        './node_modules/trumbowyg/dist/ui/trumbowyg.min.css',
        'admin/admin.sass'
    ], 'public/css/admin.css')
    .sass([
        './node_modules/reset-css/reset.css',
        './node_modules/glidejs/dist/css/glide.core.min.css',
        './node_modules/glidejs/dist/css/glide.theme.min.css',
        './node_modules/ion-rangeslider/css/ion.rangeSlider.css',
        'store/store.sass'
    ], 'public/css/store.css')
    .scripts([
        './node_modules/jquery/dist/jquery.min.js',
        './node_modules/datatables.net/js/jquery.dataTables.js',
        './node_modules/autosize/dist/autosize.min.js',
        './node_modules/select2/dist/js/select2.min.js',
        './node_modules/select2/dist/js/i18n/es.js',
        './node_modules/trumbowyg/dist/trumbowyg.min.js',
        'app.js'
    ], 'public/js/admin.js')
    .scripts([
        './node_modules/jquery/dist/jquery.min.js',
        './node_modules/glidejs/dist/glide.min.js',
        './node_modules/ion-rangeslider/js/ion.rangeSlider.min.js',
        'store.js'
    ], 'public/js/store.js')
    .livereload();
});
