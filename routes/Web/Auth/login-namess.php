<?php

Route::get('login-names/to-excel/all', 'LoginNamesController@toExcel')->name('login-names.to-excel.all');
Route::get('login-names/to-excel/all-employees', 'LoginNamesController@employeesToExcel')->name('login-names.to-excel.all-employees');
Route::resource('login-names', 'LoginNamesController');
