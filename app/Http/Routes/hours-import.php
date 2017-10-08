<?php

Route::get('/hours-import', 'HoursImportController@index')->name('admin.hours-import.index');
Route::post('/hours-import', 'HoursImportController@import')->name('admin.hours-import.import');
Route::get('/hours/by-date/{date}', 'HoursImportController@byDate')->name('admin.hours.by-date');

// Route::bind('hours-import', function($id){
//     return App\Hour::whereId($id)
//         ->with('employee')
//         ->firstOrFail();
// });

// Route::resource('hours-import', 'HoursImportController');