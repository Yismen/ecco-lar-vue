<?php

Route::get('imports', 'ImportsController@home');

Route::get('imports/employees', 'ImportsController@employees');
Route::post('imports/employees', ['as' => 'admin.imports.employees', 'uses' => 'ImportsController@handleImportEmployees']);
