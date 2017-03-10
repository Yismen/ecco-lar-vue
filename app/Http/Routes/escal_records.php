<?php

Route::bind('escalations_records', function($tracking){
    return App\EscalRecord::whereTracking($tracking)
        ->with('user')
        ->with('escal_client')
        ->firstOrFail();
});

Route::resource('escalations_records', 'EscalRecordsController', ['except'=>['show']]);


// Route::post('escalations_records/search', 'EscalRecordsController@search');

Route::bind('api/escalations_records', function($tracking){
    return App\EscalRecord::whereTracking($tracking)
        ->with('user')
        ->with('escal_client')
        ->firstOrFail();
});

Route::get('api/escalations_records/clients', 'EscalRecordsController@getClients');
Route::post('api/escalations_records/search', 'EscalRecordsController@search');
Route::resource('api/escalations_records', 'EscalRecordsController', ['except'=>['show']]);




