<?php
Route::get('escalations_hours/by_date', 'EscalationsHoursController@byDate')->name('admin.escalations_hours.byDate');
Route::post('escalations_hours/search', 'EscalationsHoursController@search')->name('admin.escalations_hours.search');
Route::get('escalations_hours/create/{user_id}/{client_id}/{records}', 'EscalationsHoursController@create')->name('admin.escalations_hours.create');
Route::bind('escalations_hours', function($id){
	return App\EscalationHour::
        with('user')
        ->with('client')
        ->findOrFail($id)
    ;
});

Route::resource('escalations_hours', 'EscalationsHoursController', ['except' => 'create']);