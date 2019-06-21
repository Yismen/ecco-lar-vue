<?php

Route::post('projects/employees', 'ProjectsController@assignEmployees');

Route::resource('projects', 'ProjectsController');
