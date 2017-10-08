<?php

Route::get('/hours-import', 'HoursImportController@index')->name('admin.hours-import.index');
Route::post('/hours-import', 'HoursImportController@import')->name('admin.hours-import.import');