<?php

/**
 * punches Routes
 * ------------------------------------------------
 */

/**
 * ===========================================================
 * Cards
 */
Route::bind('punch', function($punches){
	return App\Punch::wherePunch($punches)
		->with('employee')
		->firstOrFail();
});
Route::resource('punches', 'PunchesController');


