<?php

Route::post('profiles/image/{id}', ['as'=>'profiles.image', 'uses'=>'ProfilesController@postImage']);
Route::bind('profile', function($id){
	return App\Profile::
		// whereUserId(auth()->user()->id)
		findOrFail($id);
});
Route::resource('profiles', 'ProfilesController', ['except' => 'destroy']);	

