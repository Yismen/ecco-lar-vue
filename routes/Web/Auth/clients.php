<?php

Route::bind('client', function($id){
	return App\Client::whereId($id)
		->firstOrFail()
		->append(['department_list', 'sources_list']);
});


Route::resource('clients', 'ClientsController', [
	
]);


