<?php

Route::bind('hours', function($id){
    return App\Hour::whereId($id)
        // ->with('productions')
        ->firstOrFail();
});

Route::resource('hours', 'HourController');