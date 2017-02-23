<?php

/**
 * Payments Routes
 * ------------------------------------------------
 */

Route::bind('payments', function($id){
	return App\Payment::whereId($id)
		// ->with('departments')
		// ->with('payments')
		->firstOrFail();
});

Route::resource('payments', 'PaymentsController');