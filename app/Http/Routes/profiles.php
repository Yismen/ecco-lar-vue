<?php


	/**
	 * Profiles routes
	 * ------------------------------------------------------
	 */



/**
 * profiles index route
 */
// Route::get('profiles', [
// 	'as'=>'profiles.index',
// 	'uses'=>'ProfilesController@index',
// 	'middleware'=>['auth'],
// 	// 'roles'=>['administrator'],
// 	// 'permissions'=>['permission'],
// ]);

// /**
//  * profiles create route
//  */
// Route::get('profiles/create', [
// 	'as'=>'profiles.create',
// 	'uses'=>'ProfilesController@create',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	// 'permissions'=>['profiles_editor'],
// 	// function($profiles){
// 	// 	$article = App\Article::whereprofiles($profiles)->firstOrFail();
// 	// 	return view('profiles.create', compact('article'));
// 	// }
// ]);

// /**
//  * profiles store route
//  */
// Route::post('/profiles', [
// 	'as'=>'profiles.store',
// 	'uses'=>'ProfilesController@store',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	// 'permissions'=>['profiles_editor', 'profiles_editor'],
// ]);


// Route::bind('profiles', function($username){
// 	return App\Profile::whereUsername($username)->first();
// });

// // Route::resource('profiles', 'ProfilesController', [

// // ]);

// /**
//  * profiles show route
//  */
// Route::get('/profiles/{profiles}', [
// 	'as'=>'profiles.show',
// 	'uses'=>'ProfilesController@show',
// 	// 'middleware'=>['auth'],
// 	// 'roles'=>['administrator'],
// 	// 'permissions'=>['permission'],
// ]);

// /**
//  * profiles edit route
//  */
// Route::get('/profiles/{profiles}/edit', [
// 	'as'=>'profiles.edit',
// 	'uses'=>'ProfilesController@edit',
// 	'middleware'=>['auth'],
// 	// 'roles'=>['administrator'],
// 	// 'permissions'=>['profiles_editor'],
// ]);

// /**
//  * profiles update route
//  */
// Route::put('/profiles/{profiles}', [
// 	'as'=>'profiles.update',
// 	'uses'=>'ProfilesController@update',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	// 'permissions'=>['profiles_editor'],
// ]);

// /**
//  * profiles destroy route
//  */
// Route::delete('/profiles/{profiles}', [
// 	'as'          =>'profiles.destroy',
// 	'uses'        =>'ProfilesController@destroy',
// 	'middleware'  =>['auth','authorize'],
// 	// 'roles'    =>['administrator'],
// 	// 'permissions' =>['profiles_editor'],
// ]);

// Route::post('profiles/image_upload/{profiles}', [
// 	'as'=> 'profiles.image_upload', 
// 	'uses'=>'ProfilesController@image_upload',
// 	'middleware'=> ['auth'],
// 	// 'roles'    =>['administrator'],
// 	// 'permissions' =>['profiles_editor'],
// 	]);
/**
 * ===========================================================
 * Profiles
 */
Route::post('profiles/image/{id}', ['as'=>'profiles.image', 'uses'=>'ProfilesController@postImage']);
Route::bind('profiles', function($id){
	return App\Profile::
		// whereUserId(auth()->user()->id)
		findOrFail($id);
});
Route::resource('profiles', 'ProfilesController', ['except' => 'destroy']);	

