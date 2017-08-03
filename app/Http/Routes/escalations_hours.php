<?php
Route::post('escalations_hours/search', 'EscalationsHoursController@search')->name('admin.escalations_hours.search');
Route::bind('escalations_hours', function($id){
	return App\EscalationHour::findOrFail($id)
    ;
		// ->with('user');
});

Route::resource('escalations_hours', 'EscalationsHoursController');