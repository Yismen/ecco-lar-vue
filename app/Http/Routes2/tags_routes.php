<?php


	/**
	 * tags routes
	 * ------------------------------------------------------
	 */


/**
 * tags index route
 */
Route::get('tags', [
	'as'=>'tags.index',
	'uses'=>'TagsController@index',
	'middleware'=>['auth'],
	// 'roles'=>['administrator'],
	// 'permissions'=>['permission'],
]);

/**
 * tags create route
 */
Route::get('tags/create', [
	'as'=>'tags.create',
	'uses'=>'TagsController@create',
	'middleware'=>['auth','authorize'],
	// 'roles'=>['administrator'],
	'permissions'=>['tags_editor'],
	// function($tags){
	// 	$article = App\Article::wheretags($tags)->firstOrFail();
	// 	return view('tags.create', compact('article'));
	// }
]);

/**
 * tags store route
 */
Route::post('tags', [
	'as'=>'tags.store',
	'uses'=>'TagsController@store',
	'middleware'=>['auth','authorize'],
	// 'roles'=>['administrator'],
	'permissions'=>['tags_editor'],
]);


Route::bind('tags', function($username){
	return App\Profile::whereUsername($username)->firstOrFail();
});

// Route::resource('tags', 'TagsController', [

// ]);

/**
 * tags show route
 */
Route::get('tags/{tags}', [
	'as'=>'tags.show',
	'uses'=>'TagsController@show',
	// 'middleware'=>['auth'],
	// 'roles'=>['administrator'],
	// 'permissions'=>['permission'],
]);

/**
 * tags edit route
 */
Route::get('tags/{tags}/edit', [
	'as'=>'tags.edit',
	'uses'=>'TagsController@edit',
	'middleware'=>['auth','authorize'],
	// 'roles'=>['administrator'],
	'permissions'=>['tags_editor'],
]);

/**
 * tags update route
 */
Route::put('tags/{tags}', [
	'as'=>'tags.update',
	'uses'=>'TagsController@update',
	'middleware'=>['auth','authorize'],
	// 'roles'=>['administrator'],
	'permissions'=>['tags_editor'],
]);

/**
 * tags destroy route
 */
Route::delete('tags/{tags}', [
	'as'=>'tags.destroy',
	'uses'=>'TagsController@destroy',
	'middleware'=>['auth','authorize'],
	// 'roles'=>['administrator'],
	'permissions'=>['tags_editor'],
]);


