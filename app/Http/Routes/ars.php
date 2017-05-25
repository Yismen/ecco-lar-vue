<?php

Route::bind('ars', function($slug){
	return App\Ars::whereSlug($slug)
		->with('employees')
		->firstOrFail();
});

Route::resource('ars', 'ArsController');




