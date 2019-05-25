<?php

Route::post('supervisors/employees', 'SupervisorsController@assignEmployees');

Route::resource('supervisors', 'SupervisorsController');
