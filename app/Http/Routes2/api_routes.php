<?php
use Illuminate\Support\Facades\Cache;
/**
 * --------------------------------------------------
 * this is the main entry point to angularjs
 */
Route::get('angular', function(){
	return view('angular.index');
});

/**
 * api
 */
Route::group(['prefix'=>'api'], function(){
	/**
 * Auth Routes
 * -------------------------------------------------------
 */
	// Route::get('/auth/login', 'AngularAuthController@login');
	Route::post('/auth/login', 'AngularAuthController@login');
	Route::get('/auth/logout', 'AngularAuthController@logout');
	Route::get('/auth/check', function(){
		return response()->json(\Auth::check());
	});
/**
 * Authenticated routes
 * ---------------------------------------------------------------
 */
	Route::group(['middleware'=>'angularAuth'], function(){
		Route::get('/user', function(){
			return Auth::user();
		});
		Route::get('employees', function(){
			return \App\Employee::get();
		});
	});
/**
 * Guest Routes
 * ------------------------------------------------------------------------
 */
	Route::group([], function(){
		Route::get('employees/{id}', function($id){
			return \App\Employee::
				whereId($id)
				->with('genders')
				->with('positions')
				->with('maritals')
				->with('addresses')
				->with('logins')
				->with('card')
				->with('punch')
				->first();
		});



		Route::get('articles', [function(){
			return Cache::remember('articles_api', 30, function(){
				return \App\Article::
					with('tags')
					->orderedDesc()
					->published()
					->get();
			});
			
		}]);

		Route::get('articles/{slug}', function($slug){
			return \App\Article::
				with('tags')
				->published()
				->whereSlug($slug)
				->firstOrFail();
		});

		Route::post('articles/post', function(Illuminate\Http\Request $request){
			return $request->all();
		});

		Route::get('tags/{name}', function($name){
			return \App\Tag::
				whereName($name)
				->first()
				->articles()
				->orderedDesc()
				->published()
				->with('tags')
				->get();

		});
	});
});