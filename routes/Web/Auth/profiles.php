<?php

Route::post('profiles/image/{id}', ['as' => 'profiles.image', 'uses' => 'ProfileController@postImage']);
Route::bind('profile', function ($id) {
    return App\Profile::
        // whereUserId(auth()->user()->id)
        findOrFail($id);
});
Route::resource('profiles', 'ProfileController', ['except' => 'destroy']);
