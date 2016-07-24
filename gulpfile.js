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
    
    // mix.copy('node_modules/bootstrap/fonts', 'public/build/fonts');
    // mix.copy('node_modules/font-awesome/fonts', 'public/build/fonts');
    // mix.copy('node_modules/datatables.net-dt/images', 'public/build/images');
    // mix.copy('node_modules/summernote/dist/font', 'public/build/css/font');
    // mix.copy('node_modules/icheck/skins/square/blue.png', 'public/build/css');

	mix.styles([		
        nodeModules + '/bootstrap/dist/css/bootstrap.min.css',
        nodeModules + '/admin-lte/dist/css/AdminLTE.min.css',
        nodeModules + '/admin-lte/dist/css/skins/_all-skins.css',
        nodeModules + '/font-awesome/css/font-awesome.min.css',
        nodeModules + '/animate.css/animate.min.css',
        nodeModules + '/select2/dist/css/select2.min.css',
        nodeModules + '/select2-bootstrap-theme/dist/select2-bootstrap.css',
        nodeModules + '/summernote/dist/summernote.css',
        nodeModules + '/dropzone/dist/dropzone.css',
        nodeModules + '/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',
        nodeModules + '/icheck/skins/square/blue.css',
        // nodeModules + '/datatables.net-bs/css/dataTables.bootstrap.css',
        nodeModules + '/datatables.net-dt/css/jquery.dataTables.css',
        'my-css-updates.css',
	]);

	mix.scripts([		
        nodeModules + '/jquery/dist/jquery.min.js',
        nodeModules + '/bootstrap/dist/js/bootstrap.min.js',
        nodeModules + '/admin-lte/dist/js/app.min.js',
        nodeModules + '/bootbox/bootbox.min.js',
        nodeModules + '/select2/dist/js/select2.min.js',
        nodeModules + '/moment/moment.js',
        nodeModules + '/icheck/icheck.js',
        nodeModules + '/summernote/dist/summernote.js',
        nodeModules + '/dropzone/dist/dropzone.js',
        nodeModules + '/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
        nodeModules + '/datatables.net/js/jquery.dataTables.js',
        // nodeModules + '/datatables.net-dt/js/dataTables.bootstrap.js',
        'app.js',
        'datepicker-config.js',
        'destroy-confirmation.js',
        'hide-flashes.js',
	]);

    // mix.browserify('app/main.js');

	mix.version([
		'js/main.js', 
		'js/all.js', 
		'css/all.css'
		]);

	// mix.browserSync({
	// 	proxy: 'localhost:8000',
	// 	browser: 'google chrome'
	// });
    
});