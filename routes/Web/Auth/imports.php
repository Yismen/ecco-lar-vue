<?php

Route::get('imports', 'ImportsController@home');

Route::get('imports/employees', 'ImportsController@employees');
Route::post('imports/employees', ['as' => 'admin.imports.employees', 'uses' => 'ImportsController@handleImportEmployees']);

Route::get('imports/performances', 'ImportsController@performances');
Route::post('imports/performances', ['as' => 'admin.imports.performances', 'uses' => 'ImportsController@importPerformances']);
