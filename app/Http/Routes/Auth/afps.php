<?php

Route::bind('afps', function($slug){
	return App\Afp::whereSlug($slug)
		->with(['employees' => function($query) {
            return $query->actives();
        }])
		->firstOrFail();
});

Route::resource('afps', 'AfpsController');



