<?php

/**
 * ARticles Routes
 * ------------------------------------------------
 */

/**
 * allows to save and image presenting a FILE
 */
Route::post('articles/saveImageFromLocalFile', [
	'uses'=>'ArticlesController@saveImageFromLocalFile',
	'as'=>'articles.saveImageFromLocalFile',
	'middleware'=>['auth','authorize'],
	// 'roles'=>['administrator'],
	'permissions'=>['articles_editor'],
	]);

/**
 * allows to save and image presenting a FILE
 */
Route::post('articles/saveImageFromURL', [
	'uses'=>'ArticlesController@saveImageFromURL',
	'as'=>'articles.saveImageFromURL',
	'middleware'=>['auth','authorize'],
	// 'roles'=>['administrator'],
	'permissions'=>['articles_editor'],
	]);

/**
 * provide access to articles that has not been published yet
 */
Route::get('articles/unpublished', [
	'uses'=>'ArticlesController@unpublished',
	'as'  =>'unpublished'
	]);

/**
 * allows the users to search articles
 */
Route::get('articles/search', [
	'uses'=>'ArticlesController@search',
	'as'  =>'articles.search'
	]);

/**
 * articles index route
 */
Route::get('articles', [
	'as'=>'articles.index',
	'uses'=>'ArticlesController@index',
	// 'middleware'=>['auth','authorize'],
	// 'roles'=>['administrator'],
	// 'permissions'=>['permission'],
]);

/**
 * articles create route
 */
Route::get('articles/create', [
	'as'=>'articles.create',
	'uses'=>'ArticlesController@create',
	'middleware'=>['auth','authorize'],
	// 'roles'=>['administrator'],
	'permissions'=>['articles_editor'],
]);

/**
 * articles store route
 */
Route::post('/articles', [
	'as'=>'articles.store',
	'uses'=>'ArticlesController@store',
	'middleware'=>['auth','authorize'],
	// 'roles'=>['administrator'],
	'permissions'=>['articles_editor'],
]);

Route::bind('articles', function($slug){
	return \App\Article::whereSlug($slug)->firstOrFail();
});

// Route::resource('articles', 'ArticlesController', [
	
// ]);

/**
 * articles show route
 */
Route::get('/articles/{articles}', [
	'as'=>'articles.show',
	'uses'=>'ArticlesController@show',
	// 'middleware'=>['auth'],
	// 'roles'=>['administrator'],
	// 'permissions'=>['permission'],
]);

/**
 * articles edit route
 */
Route::get('/articles/{articles}/edit', [
	'as'=>'articles.edit',
	'uses'=>'ArticlesController@edit',
	'middleware'=>['auth','authorize'],
	// 'roles'=>['administrator'],
	'permissions'=>['articles_editor'],
]);

/**
 * articles update route
 */
Route::put('/articles/{articles}', [
	'as'=>'articles.update',
	'uses'=>'ArticlesController@update',
	'middleware'=>['auth','authorize'],
	// 'roles'=>['administrator'],
	'permissions'=>['articles_editor'],
]);

/**
 * articles destroy route
 */
Route::delete('/articles/{articles}', [
	'as'=>'articles.destroy',
	'uses'=>'ArticlesController@destroy',
	'middleware'=>['auth','authorize'],
	// 'roles'=>['administrator'],
	'permissions'=>['articles_editor'],
]);


