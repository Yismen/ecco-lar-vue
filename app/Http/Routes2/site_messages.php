<?php


	/**
	 * site_messages routes
	 * ------------------------------------------------------
	 */


/**
 * site_messages index route
 */
Route::get('site_messages', [
	'as'=>'site_messages.index',
	'uses'=>'SiteMessagesController@index',
	'middleware'=>['auth','authorize'],
	// 'site_messages'=>['administrator'],
	'permissions'=>['site_messages_editor','site_messages_viewer'],
]);

/**
 * site_messages create route
 */
// Route::get('site_messages/create', [
// 	'as'=>'site_messages.create',
// 	'uses'=>'SiteMessagesController@create',
// 	'middleware'=>['auth','authorize'],
// 	// 'site_messages'=>['administrator'],
// 	'permissions'=>['site_messages_editor'],
// ]);

/**
 * site_messages store route
 */
Route::post('site_messages', [
	'as'=>'site_messages.store',
	'uses'=>'SiteMessagesController@store',
	'middleware'=>['auth','authorize'],
	// 'site_messages'=>['administrator'],
	'permissions'=>['site_messages_editor'],
]);


Route::bind('site_messages', function($id){
	return App\SiteMessage::with('contacttypes')->findOrFail($id);
});

// Route::resource('site_messages', 'site_messages', [

// ]);

/**
 * site_messages show route
 */
Route::get('site_messages/{site_messages}', [
	'as'=>'site_messages.show',
	'uses'=>'SiteMessagesController@show',
	'middleware'=>['auth','authorize'],
	// 'site_messages'=>['administrator'],
	'permissions'=>['site_messages_editor','site_messages_viewer'],
]);

/**
 * site_messages edit route
 */
Route::get('site_messages/{site_messages}/edit', [
	'as'=>'site_messages.edit',
	'uses'=>'SiteMessagesController@edit',
	'middleware'=>['auth','authorize'],
	// 'site_messages'=>['administrator'],
	'permissions'=>['site_messages_editor'],
]);

/**
 * site_messages update route
 */
Route::put('site_messages/{site_messages}', [
	'as'=>'site_messages.update',
	'uses'=>'SiteMessagesController@update',
	'middleware'=>['auth','authorize'],
	// 'site_messages'=>['administrator'],
	'permissions'=>['site_messages_editor'],
]);

/**
 * site_messages destroy route
 */
Route::delete('site_messages/{site_messages}', [
	'as'=>'site_messages.destroy',
	'uses'=>'SiteMessagesController@destroy',
	'middleware'=>['auth','authorize'],
	// 'site_messages'=>['administrator'],
	'permissions'=>['site_messages_editor'],
]);


