<?php

Route::post('arss/employees', 'ArsController@assignEmployees');

Route::resource('arss', 'ArsController');
