<?php

/**
 * Payments Routes
 * ------------------------------------------------
 */

Route::bind('payment_types', function($id){
	return App\PaymentType::whereId($id)
		->firstOrFail();
});

Route::resource('payment_types', 'PaymentTypesController');