<?php

Route::post('import_overnight_hours', 'ImportOvernightHourController@store')
    ->name('import_overnight_hours.store');

Route::resource('overnight_hours', 'OvernightHourController')
    ->except('show');
