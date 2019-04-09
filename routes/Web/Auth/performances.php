<?php

Route::bind('performance', function ($id) {
    return App\Performance::findOrFail($id);
});

Route::resource('performances', 'PerformanceController');
