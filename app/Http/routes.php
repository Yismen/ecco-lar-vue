<?php
ini_set('xdebug.max_nesting_level', 200);

// \DB::listen(function($sql) {
// 	echo $sql->sql;
//     var_dump($sql);
// });
/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

 Route::group(['prefix'=>'api', 'middleware'=>['auth', 'api']], function(){
	foreach (File::allFiles(__DIR__.'/Routes/ApiRoutes') as $partial) {
		require_once $partial;
	}
});  

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


Route::group(['middleware' => 'web'], function () {
	/**
	 * ----------------------------------------------
	 * Test routes.									|
	 * These routes are used for development, 		|
	 * ----------------------------------------------
	 */	
	Route::get('test_plugin', function(){
		return view('test.plugin-test');		
	})->name('test.plugin');
	Route::post('test_plugin/data', function(){
		// return response()->json(["here"=>"here we go", "there"=>"We have more"], 422);
		$output = '<div class="row col-sm-12"><div class="alert alert-success">';
		$output .=	Request::input('new');
		$output .= '</div></div>';
		return response()->html($output);

	})->name('test_plugin.data');

	/**
	 * -------------------------------------------------
	 * Site routes. Usually for guests 				   |
	 * -------------------------------------------------
	 */
	Route::get('/', function () {
		return view('welcome');
	});

	Route::get('notes', ['as'=>'notes.index', 'uses'=>'NotesController@getNotes']);
	Route::get('notes/search', ['as'=>'notes.search', 'uses'=>'NotesController@searchNotes']);
	Route::get('date_calc', ['as'=>'date_calc.index', 'uses'=>'DateCalcController@index']);
	Route::get('date_calc/from_today', ['as'=>'date_calc.diff_from_today', 'uses'=>'DateCalcController@diffFromToday']);
	Route::get('date_calc/range_diff', ['as'=>'date_calc.range_diff', 'uses'=>'DateCalcController@rangeDiff']);



	/**
	 * ----------------------------------------------
	 * Admin Routes 								|
	 * ----------------------------------------------
	 */
	Route::group(['prefix' => 'admin'], function() {
	    
	    Route::auth();  

	    Route::get('/', function () {
			$user = Auth::user();

			if($user && !$user->profile) return redirect()->route('admin.profiles.create');

	    	return view('welcome', compact('user'));
		});

		/**
		 * ----------------------------------------------
		 * Admin routes requiring authentication        |
		 * ----------------------------------------------
		 */
	    Route::group(['middleware' => 'auth'], function() {	
	    	Route::get('passwords', 'PasswordController@home')->name('admin.passwords.index');
			Route::get('test-datatables', 'TestController@testDatatablesView')->name('test.datatables');
			Route::get('test-datatables/data', 'TestController@testDatatablesData')->name('test.datatables.data');

			

			/**
			 * ------------------------------------------
			 * Home Routes 								|
			 * ------------------------------------------
			 */
	    	Route::get('/home', function(){
	    		return Auth::user()->rolesList;
	    	});
				

	        /**
			 * =========================================
			 * Note Routes 								|
			 * =========================================
			 */
			Route::bind('notes', function($slug) {
				return App\Note::whereSlug($slug)->firstOrFail();
			});
			Route::get('notes/trashed', ['as'=>'admin.notes.trashed', 'uses'=>'NotesController@trashedNotes']);
			Route::get('notes/restore/{slug}', ['as'=>'admin.notes.restore', 'uses'=>'NotesController@restoreNotes']);
			Route::resource('notes', 'NotesController');

			

			/**
			 * get other routes registered externally
			 */
			foreach (File::allFiles(__DIR__.'/Routes') as $partial) {
				require_once $partial;
			}
	    }); // middleware auth
	});
    
});



// Route::auth();

// Route::get('/home', 'HomeController@index');
