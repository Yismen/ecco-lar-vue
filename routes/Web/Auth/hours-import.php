<?php

Route::get('/hours-import', 'HoursImportController@index')->name('hours-import.index');
Route::post('/hours-import', 'HoursImportController@import')->name('hours-import.import');
