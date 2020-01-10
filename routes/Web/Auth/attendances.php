<?php

Route::get('attendances/date/{date}', 'AttendancesController@date')->name('attendances.date');
Route::get('attendances/employee/{employee}', 'AttendancesController@employee')->name('attendances.employee');
Route::get('attendances/code/{code}', 'AttendancesController@code')->name('attendances.code');

Route::resource('attendances', 'AttendancesController');
