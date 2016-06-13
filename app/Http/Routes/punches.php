<?php

/**
 * punches Routes
 * ------------------------------------------------
 */

/**
 * ===========================================================
 * Cards
 */
Route::bind('punches', function($punches){
	return App\Punch::wherePunch($punches)
		->with('employee')
		->firstOrFail();
});
Route::resource('punches', 'PunchesController');


