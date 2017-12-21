<?php

Route::bind('escalations_clients', function($slug){
	return App\EscalClient::whereSlug($slug)
		// ->with('user')
		->firstOrFail();
});

Route::resource('escalations_clients', 'EscalClientsController');




