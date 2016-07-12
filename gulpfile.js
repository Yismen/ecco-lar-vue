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
 //    mix.sass('app.scss');
 //    
    // mix.copy('node_modules/bootstrap/fonts', 'public/build/fonts');
    // mix.copy('node_modules/font-awesome/fonts', 'public/build/fonts');
    // mix.copy('node_modules/summernote/dist/fonts', 'public/build/fonts');

	mix.styles([		
        nodeModules + '/bootstrap/dist/css/bootstrap.min.css',
        nodeModules + '/admin-lte/dist/css/AdminLTE.min.css',
        nodeModules + '/admin-lte/dist/css/skins/_all-skins.css',
        nodeModules + '/font-awesome/css/font-awesome.min.css',
        nodeModules + '/animate.css/animate.min.css',
        nodeModules + '/summernote/dist/summernote.css',
        nodeModules + '/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',
        nodeModules + '/datatables.net-bs/css/dataTables.bootstrap.css',
	]);

	mix.scripts([		
        nodeModules + '/jquery/dist/jquery.min.js',
        nodeModules + '/bootstrap/dist/js/bootstrap.min.js',
        nodeModules + '/admin-lte/dist/js/app.min.js',
        nodeModules + '/bootbox/bootbox.min.js',
        nodeModules + '/moment/moment.js',
        nodeModules + '/summernote/dist/summernote.js',
        nodeModules + '/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
        nodeModules + '/datatables.net/js/jquery.dataTables.js',
        nodeModules + '/datatables.net-bs/js/dataTables.bootstrap.js',
        'datepicker-config.js',
	]);

    mix.browserify('app/main.js');

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