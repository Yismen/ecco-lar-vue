<?php

/**
 * Positions Routes
 * ------------------------------------------------
 */

Route::bind('position', function($id){
	return App\Position::whereId($id)
		->with('department')
        ->with('payment_type')
		->with('payment_frequency')
		->firstOrFail();
});

Route::resource('positions', 'PositionsController');


