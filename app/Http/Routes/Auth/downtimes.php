<?php

Route::post('downtimes/import', 'DowntimesController@importByDate')->name('admin.downtimes.import');

Route::bind('downtimes', function($id){
	return App\Downtime::with('employee.positions')->with('reason')->findOrFail($id);
});

Route::resource('downtimes', 'DowntimesController');


