<?php

Route::bind('hours', function($id){
    return App\Hour::whereId($id)
        ->with('employee')
        ->firstOrFail();
});

// Route::resource('hours', 'HoursController');