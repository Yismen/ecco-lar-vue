<?php

Route::post('downtimes/import', 'DowntimesController@importByDate')->name('downtimes.import');

Route::bind('downtime', function($id){
	return App\Downtime::with('employee.positions')->with('reason')->findOrFail($id);
});

Route::resource('downtimes', 'DowntimesController');


