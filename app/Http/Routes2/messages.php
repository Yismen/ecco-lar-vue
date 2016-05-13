<?php


	/**
	 * messages routes
	 * ------------------------------------------------------
	 */


/**
 * messages index route
 */
Route::get('messages', [
	'as'=>'messages.index',
	'uses'=>'MessagesController@index',
	'middleware'=>['auth','authorize'],
	// 'messages'=>['administrator'],
	'permissions'=>['messages_editor','messages_viewer'],
]);

/**
 * messages create route
 */
Route::get('messages/create', [
	'as'=>'messages.create',
	'uses'=>'MessagesController@create',
	'middleware'=>['auth','authorize'],
	// 'messages'=>['administrator'],
	'permissions'=>['messages_editor'],
]);

/**
 * messages store route
 */
Route::post('messages', [
	'as'=>'messages.store',
	'uses'=>'MessagesController@store',
	'middleware'=>['auth','authorize'],
	// 'messages'=>['administrator'],
	'permissions'=>['messages_editor'],
]);


Route::bind('messages', function($username){
	return App\User::whereUsername($username)->with('messages')->firstOrFail();
});

// Route::resource('messages', 'messages', [

// ]);

/**
 * messages show route
 */
Route::get('messages/{messages}', [
	'as'=>'messages.show',
	'uses'=>'MessagesController@show',
	'middleware'=>['auth','authorize'],
	// 'messages'=>['administrator'],
	'permissions'=>['messages_editor','messages_viewer'],
]);

/**
 * messages edit route
 */
Route::get('messages/{messages}/edit', [
	'as'=>'messages.edit',
	'uses'=>'MessagesController@edit',
	'middleware'=>['auth','authorize'],
	// 'messages'=>['administrator'],
	'permissions'=>['messages_editor'],
]);

/**
 * messages update route
 */
Route::put('messages/{messages}', [
	'as'=>'messages.update',
	'uses'=>'MessagesController@update',
	'middleware'=>['auth','authorize'],
	// 'messages'=>['administrator'],
	'permissions'=>['messages_editor'],
]);

/**
 * messages destroy route
 */
Route::delete('messages/{messages}', [
	'as'=>'messages.destroy',
	'uses'=>'MessagesController@destroy',
	'middleware'=>['auth','authorize'],
	// 'messages'=>['administrator'],
	'permissions'=>['messages_editor'],
]);


