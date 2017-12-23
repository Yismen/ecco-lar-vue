<?php
ini_set('xdebug.max_nesting_level', 200);

Route::group(['prefix'=>'api', 'middleware'=>['auth', 'api']], function(){
	foreach (File::allFiles(__DIR__.'/Routes/ApiRoutes') as $partial) {
		require_once $partial;
	}
});

Route::group(['middleware' => 'web'], function () {

	/**
	 * -------------------------------------------------
	 * Site routes. Usually for guests 				   |
	 * -------------------------------------------------
	 */
	Route::get('/', function () {
		return view('auth.login');
	});

    foreach (File::allFiles(__DIR__.'/Routes/Web') as $partial) {
        require_once $partial;
    }

	/**
	 * ----------------------------------------------
	 * Admin Routes 								|
	 * ----------------------------------------------
	 */
	Route::group(['prefix' => 'admin'], function() {
	    // dd(Config::get('mail', 'default'));
	    Route::auth();  

		/**
		 * ----------------------------------------------
		 * Admin routes requiring authentication        |
		 * ----------------------------------------------
		 */
	    Route::group(['middleware' => 'auth'], function() {	

		    Route::get('/', function () {
				$user = Auth::user();

				if($user && !$user->profile) return redirect()->route('admin.profiles.create');

		    	return view('welcome', compact('user'));
			});

			foreach (File::allFiles(__DIR__.'/Routes/Auth') as $partial) {
				require_once $partial;
			}
	    }); // middleware auth
	});
    
});
