<?php

Route::post('sites/employees', 'SitesController@assignEmployees');

Route::resource('sites', 'SitesController');
