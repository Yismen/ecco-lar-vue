<?php

Route::get('performances_import/by_date/{perf_date}', 'PerformanceImportController@show')->name('performances_import.by_date');
Route::resource('performances_import', 'PerformanceImportController')->except(['show', 'edit', 'update']);

// Route::get('performances/by_date/{perf_date}', 'PerformanceController@byDate')->name('performances.by_date');
// Route::delete('performances/mass_delete', 'PerformanceController@wantsMassDelete')->name('performances.mass_delete');

Route::resource('performances', 'PerformanceController')
    ->except('create', 'store');

Route::resource('downtimes', 'DowntimeController')
    ->except('show');
