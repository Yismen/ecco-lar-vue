<?php

Route::get('login_names/to-excel/all', 'LoginNamesController@toExcel')->name('login_names.to-excel.all');
Route::get('login_names/to-excel/all-employees', 'LoginNamesController@employeesToExcel')->name('login_names.to-excel.all-employees');
Route::resource('login_names', 'LoginNamesController');
