<?php


Route::get('/hours/by-date/{date}', 'HoursController@byDate')->name('admin.hours.by-date');

Route::bind('hours', function($id){
    return App\Hour::whereId($id)
        ->with('employee')
        ->firstOrFail();
});

Route::resource('hours', 'HoursController');