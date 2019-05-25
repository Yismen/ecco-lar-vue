<?php

Route::post('supervisors/employees', 'SupervisorsController@reAssign');

Route::resource('supervisors', 'SupervisorsController');
