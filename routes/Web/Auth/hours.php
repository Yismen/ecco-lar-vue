<?php

Route::get('/hours/by-date/{date}', 'HoursController@byDate')->name('hours.by-date');

Route::bind('hour', function ($id) {
    return App\Hour::whereId($id)
        ->with('employee')
        ->firstOrFail();
});

Route::resource('hours', 'HoursController');
