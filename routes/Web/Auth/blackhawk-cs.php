<?php

Route::get('bhcs_manager', 'BlackHawkCS\ManagementController@index');
Route::get('blackhawk_cs/api/dashboard/management', 'BlackHawkCS\ManagementController@dashboard');

Route::get('bhcs_statistic', 'BlackHawkCS\Statistic\ImportController@index');

Route::post('bhcs_statistic/import/qa', 'BlackHawkCS\Statistic\ImportController@qa')->name('import-qa');
Route::post('bhcs_statistic/import/qa-errors', 'BlackHawkCS\Statistic\ImportController@qaErrors')->name('import-qa-errors');
Route::post('bhcs_statistic/import/lob', 'BlackHawkCS\Statistic\ImportController@lob')->name('import-lob-summary');
Route::post('bhcs_statistic/import/performance', 'BlackHawkCS\Statistic\ImportController@performance')->name('import-performance');

Route::get('bhcs_supervisor', 'BlackHawkCS\SupervisorController@index');
Route::get('blackhawk_cs/api/dashboard/supervisor', 'BlackHawkCS\SupervisorController@dashboard');
