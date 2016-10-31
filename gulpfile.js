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
var nodeModules = '../../../node_modules';


elixir(function(mix) {
    // mix.sass('app.scss');
    
    mix.copy('node_modules/bootstrap/fonts', 'public/build/fonts');
    mix.copy('node_modules/ionicons/dist/fonts', 'public/build/fonts');
    mix.copy('node_modules/font-awesome/fonts', 'public/build/fonts');
    mix.copy('node_modules/datatables.net-dt/images', 'public/build/images');
    mix.copy('node_modules/summernote/dist/font', 'public/build/css/font');
    mix.copy('node_modules/icheck/skins/square/blue.png', 'public/build/css');

	mix.styles([		
        nodeModules + '/bootstrap/dist/css/bootstrap.min.css',
        nodeModules + '/admin-lte/dist/css/AdminLTE.min.css',
        nodeModules + '/admin-lte/plugins/daterangepicker/daterangepicker.css',
        nodeModules + '/admin-lte/dist/css/skins/_all-skins.css',
        nodeModules + '/font-awesome/css/font-awesome.css',
        nodeModules + '/ionicons/dist/css/ionicons.css',
        nodeModules + '/animate.css/animate.css',
        nodeModules + '/select2/dist/css/select2.css',
        nodeModules + '/select2-bootstrap-theme/dist/select2-bootstrap.css',
        nodeModules + '/summernote/dist/summernote.css',
        nodeModules + '/dropzone/dist/dropzone.css',
        nodeModules + '/bootstrap-datepicker/dist/css/bootstrap-datepicker.css',
        nodeModules + '/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css',
        nodeModules + '/icheck/skins/square/blue.css',
        nodeModules + '/datatables.net-dt/css/jquery.dataTables.css',
        nodeModules + '/datatables.net-bs/css/dataTables.bootstrap.css',
        nodeModules + '/datatables.net-buttons-dt/css/buttons.dataTables.css',
        'my-css-updates.css',
	]);

	mix.scripts([		
        nodeModules + '/jquery/dist/jquery.js',
        nodeModules + '/bootstrap/dist/js/bootstrap.js',
        nodeModules + '/admin-lte/dist/js/app.js',
        nodeModules + '/bootbox/bootbox.js',
        nodeModules + '/select2/dist/js/select2.js',
        nodeModules + '/admin-lte/plugins/daterangepicker/moment.js',
        nodeModules + '/admin-lte/plugins/daterangepicker/daterangepicker.js',
        nodeModules + '/icheck/icheck.js',
        nodeModules + '/summernote/dist/summernote.js',
        nodeModules + '/dropzone/dist/dropzone.js',
        nodeModules + '/js-cookie/src/js.cookie.js',
        nodeModules + '/bootstrap-datepicker/dist/js/bootstrap-datepicker.js',
        nodeModules + '/bootstrap-timepicker/js/bootstrap-timepicker.js',
        nodeModules + '/eonasdan-bootstrap-datetimepicker/src/js/bootstrap-datetimepicker.js',
        nodeModules + '/datatables.net/js/jquery.dataTables.js',
        nodeModules + '/datatables.net-buttons/js/dataTables.buttons.js',

        // nodeModules + '/datatables.net-bs/js/dataTables.bootstrap.js',
        'app.js',
        'ajaxSetup.js',
        'myFormSubmit.js',
        'confirmBeforeDestroy.js',
        'destroyFlashMessage.js',
	]);

    // mix.browserify('passwords/app.js', 'public/js/passwords.js');

	mix.version([
		'js/all.js', 
		'css/all.css'
	]);

	// mix.browserSync({
	// 	proxy: 'localhost:8000',
	// 	browser: 'google chrome'
	// });
    
});