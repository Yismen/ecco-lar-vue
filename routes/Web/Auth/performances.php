<?php

Route::delete('performances/date/{perf_date}/campaign/{perf_campaign}', 'PerformanceController@destroy');
Route::get('performances/{perf_date}', 'PerformanceController@show');

Route::resource('performances', 'PerformanceController')->except('create');
