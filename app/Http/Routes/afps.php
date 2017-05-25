<?php

Route::bind('afps', function($slug){
	return App\Afps::whereSlug($slug)
		->with('employees')
		->firstOrFail();
});

Route::resource('afps', 'AfpsController');




