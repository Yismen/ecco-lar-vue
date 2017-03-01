<?php

Route::bind('escalations_records', function($tracking){
    return App\EscalRecord::whereTracking($tracking)
        ->with('user')
        ->with('escal_client')
        ->firstOrFail();
});

Route::resource('escalations_records', 'EscalRecordsController', ['except'=>['show']]);




