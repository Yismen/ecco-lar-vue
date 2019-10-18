<?php

Route::get('performances_import/by_date/{perf_date}', 'PerformanceImportController@show')->name('performances_import.by_date');
Route::get('/performances_import/mass_delete', 'PerformanceImportController@confirmDestroy');
Route::resource('performances_import', 'PerformanceImportController')->except(['show', 'edit', 'update']);

// Route::get('performances/by_date/{perf_date}', 'PerformanceController@byDate')->name('performances.by_date');
// Route::delete('performances/mass_delete', 'PerformanceController@wantsMassDelete')->name('performances.mass_delete');

Route::resource('performances', 'PerformanceController');
