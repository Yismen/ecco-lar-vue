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
    // mix.copy(nodeModules+'/font-awesome/fonts', 'public/fonts');
    // mix.copy(nodeModules+'/summernote/dist/fonts', 'public/fonts');

	// mix.styles([		
 //        nodeModules + '/bootstrap/dist/css/bootstrap.css',
 //        nodeModules + '/admin-lte/dist/css/AdminLTE.css',
 //        nodeModules + '/admin-lte/dist/css/skins/_all-skins.css',
 //        nodeModules + '/font-awesome/css/font-awesome.css',
 //        nodeModules + '/animate.css/animate.css',
 //        nodeModules + '/summernote/dist/summernote.css',
	// ]);

	// mix.scripts([		
 //        nodeModules + '/jquery/dist/jquery.js',
 //        nodeModules + '/bootstrap/dist/js/bootstrap.js',
 //        nodeModules + '/admin-lte/dist/js/app.min.js',
 //        nodeModules + '/bootbox/bootbox.js',
 //        nodeModules + '/moment/moment.js',
 //        nodeModules + '/summernote/dist/summernote.js',
	// ]);

    mix.browserify('app/main.js');

	mix.version([
		'js/main.js', 
		'js/all.js', 
		'css/all.css'
		]);

	// mix.browserSync({
	// 	local: 'http://localhost:8000',
	// 	browser: 'google chrome'
	// });
    
});