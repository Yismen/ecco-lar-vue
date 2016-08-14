<?php

/**
 * downtimes index route
 */

Route::get('downtimes/searchScope', [
	'as'=>'admin.downtimes.searchScope',
	'uses'=>'DowntimesController@searchScope',
	'middleware'=>['auth'],
	// 'roles'=>['administrator'],
	'permissions'=>['downtimes_viewer'],
]);

Route::get('downtimes/searchRange', [
	'as'=>'admin.downtimes.searchRange',
	'uses'=>'DowntimesController@searchRange',
	'middleware'=>['auth'],
	// 'roles'=>['administrator'],
	'permissions'=>['downtimes_viewer'],
]);

Route::get('downtimes/searchByValue', [
	'as'=>'admin.downtimes.searchByValue',
	'uses'=>'DowntimesController@searchByValue',
	'middleware'=>['auth'],
	// 'roles'=>['administrator'],
	'permissions'=>['downtimes_viewer'],
]);

Route::get('downtimes/import', 'DowntimesController@importByDate');

Route::bind('downtimes', function($id){
	return App\Downtime::with('employee')->with('reason')->findOrFail($id);
});

Route::resource('downtimes', 'DowntimesController');



// Route::get('downtimes', [
// 	'as'=>'downtimes.index',
// 	'uses'=>'DowntimesController@index',
// 	'middleware'=>['auth'],
// 	// 'roles'=>['administrator'],
// 	// 'permissions'=>['permission'],
// ]);

// /**
//  * downtimes create route
//  */
// Route::get('downtimes/create', [
// 	'as'=>'downtimes.create',
// 	'uses'=>'DowntimesController@create',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	// 'permissions'=>['downtimes_editor'],
// 	// function($downtimes){
// 	// 	$article = App\Article::wheredowntimes($downtimes)->firstOrFail();
// 	// 	return view('downtimes.create', compact('article'));
// 	// }
// ]);

// /**
//  * downtimes store route
//  */
// Route::post('/downtimes', [
// 	'as'=>'downtimes.store',
// 	'uses'=>'DowntimesController@store',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	// 'permissions'=>['downtimes_editor', 'downtimes_editor'],
// ]);


// Route::bind('downtimes', function($id){
// 	return App\Downtime::with('employee')->with('reason')->findOrFail($id);
// });

// // Route::resource('downtimes', 'DowntimesController', [

// // ]);

// /**
//  * downtimes show route
//  */
// Route::get('/downtimes/{downtimes}', [
// 	'as'=>'downtimes.show',
// 	'uses'=>'DowntimesController@show',
// 	'middleware'=>['auth'],
// 	// 'roles'=>['administrator'],
// 	// 'permissions'=>['permission'],
// ]);

// /**
//  * downtimes edit route
//  */
// Route::get('/downtimes/{downtimes}/edit', [
// 	'as'=>'downtimes.edit',
// 	'uses'=>'DowntimesController@edit',
// 	'middleware'=>['auth'],
// 	// 'roles'=>['administrator'],
// 	// 'permissions'=>['downtimes_editor'],
// ]);

// /**
//  * downtimes update route
//  */
// Route::put('/downtimes/{downtimes}', [
// 	'as'=>'downtimes.update',
// 	'uses'=>'DowntimesController@update',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	// 'permissions'=>['downtimes_editor'],
// ]);

// /**
//  * downtimes destroy route
//  */
// Route::delete('/downtimes/{downtimes}', [
// 	'as'          =>'downtimes.destroy',
// 	'uses'        =>'DowntimesController@destroy',
// 	'middleware'  =>['auth','authorize'],
// 	// 'roles'    =>['administrator'],
// 	// 'permissions' =>['downtimes_editor'],
// ]);

// Route::post('downtimes/image_upload/{downtimes}', [
// 	'as'=> 'downtimes.image_upload', 
// 	'uses'=>'DowntimesController@image_upload',
// 	'middleware'=> ['auth'],
// 	// 'roles'    =>['administrator'],
// 	// 'permissions' =>['downtimes_editor'],
// 	]);


