<?php

/**
 * Payments Routes
 * ------------------------------------------------
 */

Route::bind('payment_frequencies', function($id){
	return App\PaymentFrequency::whereId($id)
		->firstOrFail();
});

Route::resource('payment_frequencies', 'PaymentFrequenciesController');