<?php

Route::resource('escalations_records', 'EscalRecordsController', ['except' => ['show']]);

Route::get('api/escalations_records/clients', 'EscalRecordsController@getClients');
Route::post('escalations_records/search', 'EscalRecordsController@search');
Route::post('api/escalations_records/search', 'EscalRecordsController@search');
Route::resource('api/escalations_records_api', 'EscalRecordsController', ['except' => ['show']]);
