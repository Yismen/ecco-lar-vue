<?php

Route::post('nationalities/employees', 'NationalitiesController@assignEmployees');

Route::resource('nationalities', 'NationalitiesController');
