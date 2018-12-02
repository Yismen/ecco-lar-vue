<?php

Route::bind('arss', function ($slug) {
    return App\Ars::whereSlug($slug)
        ->with(['employees' => function ($query) {
            return $query->orderBy('first_name')->actives();
        }])
        ->firstOrFail();
});

Route::resource('arss', 'ArsController');
