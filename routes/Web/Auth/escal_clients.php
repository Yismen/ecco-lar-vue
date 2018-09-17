<?php

Route::bind('escalations_client', function ($slug) {
    return App\EscalClient::whereSlug($slug)
        // ->with('user')
        ->firstOrFail();
});

Route::resource('escalations_clients', 'EscalClientsController');
