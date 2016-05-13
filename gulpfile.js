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

    // mix.copy('node_modules/vue', 'resources/assets/js/app/modules/vue');
    // mix.copy('node_modules/vue-resource', 'resources/assets/js/app/modules/vue-resource');
    // mix.copy('node_modules/vue-validator', 'resources/assets/js/app/modules/vue-validator');

 //    mix.sass('app.scss');

	// mix.styles([		
 //        nodeModules + '/bootstrap/dist/css/bootstrap.css',
 //        nodeModules + '/admin-lte/dist/css/AdminLTE.css',
 //        nodeModules + '/admin-lte/dist/css/skins/_all-skins.css',
 //        nodeModules + '/admin-lte/dist/css/skins/_all-skins.css'
	// ]);


	// mix.scripts([		
 //        nodeModules + '/jquery/dist/jquery.js',
 //        nodeModules + '/bootstrap/dist/js/bootstrap.js',
 //        nodeModules + '/admin-lte/dist/js/app.min.js',
 //        nodeModules + '/admin-lte/dist/js/app.min.js'
	// ]);
	// 
    mix.browserify('app/main.js');
	mix.version([
		'js/main.js', 
		'js/all.js', 
		'css/all.css'
		]);
    
});