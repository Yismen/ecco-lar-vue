<?php

Route::post('afps/employees', 'AfpsController@assignEmployees');

Route::resource('afps', 'AfpsController');
