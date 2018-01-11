let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as bundling up your JS files.
 |
 */

var nodeModules = '../../../node_modules';
mix
    // .copy('node_modules/bootstrap/fonts', 'public/build/fonts/bootstrap')
    // .copy('node_modules/ionicons/dist/fonts', 'public/build/fonts')
    // .copy('node_modules/font-awesome/fonts', 'public/build/fonts')
    // .copy('node_modules/datatables.net-dt/images', 'public/build/images')
    // .copy('node_modules/summernote/dist/font', 'public/build/css/font')
    // .copy('node_modules/icheck/skins/square/blue.png', 'public/build/css')
    // .copy('node_modules/bootstrap-sass/assets/stylesheets/bootstrap', 'resources/assets/sass/bootstrap-sass')
    // .sass('resources/assets/sass/app.scss', 'resources/assets/css/bootstrap.css')
    // .copy('node_modules/jorge.form', 'resources/assets/js/dainsys/vendor')
    // .copy('node_modules/dainsys-form', 'resources/assets/js/dainsys/vendor/dainsys-form')
    .js('resources/assets/js/dainsys/app.js', 'public/js/dainsys')
    // .version()
    
   //  .styles([       
   //      // 'bootstrap.css',
   //      // nodeModules + '/admin-lte/dist/css/AdminLTE.min.css',
   //      // nodeModules + '/admin-lte/dist/css/skins/_all-skins.css',
   //      // nodeModules + '/admin-lte/plugins/daterangepicker/daterangepicker.css',
   //      // nodeModules + '/animate.css/animate.css',
   //      // nodeModules + '/bootstrap-datepicker/dist/css/bootstrap-datepicker.css',
   //      // nodeModules + '/bootstrap-material-design/dist/css/bootstrap-material-design.css',
   //      // // nodeModules + '/bootstrap-material-design/dist/css/ripples.css',
   //      // nodeModules + '/datatables.net-bs/css/dataTables.bootstrap.css',
   //      // nodeModules + '/datatables.net-dt/css/jquery.dataTables.css',
   //      // nodeModules + '/datatables.net-buttons-dt/css/buttons.dataTables.css',
   //      // nodeModules + '/dropzone/dist/dropzone.css',
   //      // nodeModules + '/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css',
   //      // nodeModules + '/font-awesome/css/font-awesome.css',
   //      // nodeModules + '/icheck/skins/square/blue.css',
   //      // nodeModules + '/ionicons/dist/css/ionicons.css',
   //      // nodeModules + '/select2-bootstrap-theme/dist/select2-bootstrap.css',
   //      // nodeModules + '/select2/dist/css/select2.css',
   //      // nodeModules + '/morris.js/morris.css',
   //      // nodeModules + '/summernote/dist/summernote.css',
   //      // 'my-css-updates.css',
   //      // 'btn-raised.css',
   // ], public/css/all.css)
    // .scripts([      
    //     nodeModules + '/jquery/dist/jquery.js',
    //     nodeModules + '/bootstrap/dist/js/bootstrap.js',
    //     nodeModules + '/admin-lte/plugins/daterangepicker/moment.js',
        
    //     nodeModules + '/admin-lte/dist/js/app.js',
    //     nodeModules + '/admin-lte/plugins/daterangepicker/daterangepicker.js',
    //     nodeModules + '/bootbox/bootbox.js',
    //     nodeModules + '/bootstrap-datepicker/dist/js/bootstrap-datepicker.js',
    //     nodeModules + '/bootstrap-timepicker/js/bootstrap-timepicker.js',
    //     // nodeModules + '/bootstrap-material-design/dist/js/material.js',
    //     // nodeModules + '/bootstrap-material-design/dist/js/ripples.js',
    //     nodeModules + '/datatables.net/js/jquery.dataTables.js',
    //     nodeModules + '/datatables.net-buttons/js/dataTables.buttons.js',
    //     nodeModules + '/datatables.net-bs/js/dataTables.bootstrap.js',
    //     nodeModules + '/dropzone/dist/dropzone.js',
    //     nodeModules + '/eonasdan-bootstrap-datetimepicker/src/js/bootstrap-datetimepicker.js',
    //     nodeModules + '/icheck/icheck.js',
    //     nodeModules + '/morris.js/morris.js',
    //     nodeModules + '/raphael/raphael.js',
    //     nodeModules + '/chart.js/dist/Chart.js',
    //     nodeModules + '/js-cookie/src/js.cookie.js',
    //     nodeModules + '/select2/dist/js/select2.js',
    //     nodeModules + '/summernote/dist/summernote.js',

    //     'app.js',
    //     'ajaxSetup.js',
    //     'myFormSubmit.js',
    //     'confirmBeforeDestroy.js',
    //     'destroyFlashMessage.js',
    // ])
    // .browserify('passwords/app.js', 'public/js/passwords.js')
    // .browserify('dainsys/app.js')
    // .version([
    //     'js/all.js', 
    //     'js/app.js',
    //     'js/dainsys/app.js',
    //     'css/all.css'
    // ]);;

// .browserSync({
//   proxy: 'dainsys.dev',
//   browser: 'firefox'
//   // browser: 'Chrome'
// })
;

// Full API
// mix.js(src, output);
// mix.react(src, output); <-- Identical to mix.js(), but registers React Babel compilation.
// mix.extract(vendorLibs);
// mix.sass(src, output);
// mix.standaloneSass('src', output); <-- Faster, but isolated from Webpack.
// mix.less(src, output);
// mix.stylus(src, output);
// mix.browserSync('my-site.dev');
// mix.combine(files, destination);
// mix.babel(files, destination); <-- Identical to mix.combine(), but also includes Babel compilation.
// mix.copy(from, to);
// mix.copyDirectory(fromDir, toDir);
// mix.minify(file);
// mix.sourceMaps(); // Enable sourcemaps
// mix.version(); // Enable versioning.
// mix.disableNotifications();
// mix.setPublicPath('path/to/public');
// mix.setResourceRoot('prefix/for/resource/locators');
// mix.autoload({}); <-- Will be passed to Webpack's ProvidePlugin.
// mix.webpackConfig({}); <-- Override webpack.config.js, without editing the file directly.
// mix.then(function () {}) <-- Will be triggered each time Webpack finishes building.
// mix.options({
//   extractVueStyles: false, // Extract .vue component styling to file, rather than inline.
//   processCssUrls: true, // Process/optimize relative stylesheet url()'s. Set to false, if you don't want them touched.
//   purifyCss: false, // Remove unused CSS selectors.
//   uglify: {}, // Uglify-specific options. https://webpack.github.io/docs/list-of-plugins.html#uglifyjsplugin
//   postCss: [] // Post-CSS options: https://github.com/postcss/postcss/blob/master/docs/plugins.md
// });
