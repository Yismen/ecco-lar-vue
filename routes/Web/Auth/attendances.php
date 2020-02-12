<?php

use Illuminate\Support\Facades\Route;

Route::get('attendances/date/{date}', 'Attendance\DateController@show')->name('attendances.date');
Route::get('attendances/code/{code}', 'Attendance\CodeController@show')->name('attendances.code');
// Route::get('attendances/employee/{employee}', 'Attendance\EmployeeController@show')->name('attendances.employee');

Route::resource('attendances', 'AttendancesController');
