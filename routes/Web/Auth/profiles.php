<?php

Route::post('profiles/image/{id}', ['as' => 'profiles.image', 'uses' => 'ProfileController@postImage']);
Route::resource('profiles', 'ProfileController', ['except' => 'destroy']);
