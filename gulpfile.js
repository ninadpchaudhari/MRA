var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {

    mix.styles([
        'normalize.css',
        'materialize.min.css',
        'handsontable.full.css'
    ],'public/css/vendor.css');
    mix.browserify('app.js');
    mix.browserify('admin.js');

    mix.scripts([
        'vendor/modernizr-2.8.3.min.js',
        'vendor/jquery-1.11.3.min.js',
        'vendor/materialize.min.js',
        'vendor/vue.js',
        'vendor/vue-router.min.js',
        'vendor/vue-resource.js',
        'vendor/select2-4.0.0.min.js',
        'vendor/handsontable.full.js'
    ],'public/js/vendor.js');
    mix.scripts([
        'vendor/modernizr-2.8.3.min.js',
        'vendor/jquery-1.11.3.min.js',
        'vendor/materialize.min.js',
        'vendor/select2-4.0.0.min.js',
        'vendor/handsontable.full.js'
    ],'public/js/vendor-no-vue.js');

    mix.sass('app.scss');
    mix.sass('admin.scss');
    /**
     * Add versioning to punlic folder's js and css when in production.
     */
   mix.version(['js/app.js','css/app.css','js/admin.js','css/admin.css']);

});
