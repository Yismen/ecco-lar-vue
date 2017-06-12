<?php

Route::bind('ars', function($slug){
	return App\Ars::whereSlug($slug)
		->with(['employees' => function($query) {
            return $query->actives();
        }])
		->firstOrFail();
});

Route::resource('ars', 'ArsController');




