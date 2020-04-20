<?php

Route::group(['middleware' => 'authorize:view-human-resources-dashboard'], function () {
    Route::get('human_resources', ['as' => 'human_resources.index', 'uses' => 'Dashboards\HumanResourcesDashboardController@index']);
    // Route::get('human_resources', ['as' => 'human_resources.index', 'uses' => 'HumanResourcesController@index']);

    Route::get('human_resources/employees/dgt3', 'HumanResources\DGT3Controller@dgt3');
    Route::get('human_resources/employees/dgt3_to_excel/{year}', 'HumanResources\DGT3Controller@dgt3ToExcel');
    Route::post('human_resources/employees/dgt3', 'HumanResources\DGT3Controller@handleDgt3');

    Route::get('human_resources/employees/dgt4', 'HumanResources\DGT4Controller@dgt4');
    Route::post('human_resources/employees/dgt4', 'HumanResources\DGT4Controller@handleDgt4');
    Route::get('human_resources/employees/dgt4_to_excel/{year}/{month}', 'HumanResources\DGT4Controller@dgt4ToExcel');

    Route::get('human_resources/employees/dgt4_to_excel/{year}', 'HumanResources\DGT4Controller@dgt3ToExcel');

    Route::get('human_resources/birthdays/this_month', 'HumanResourcesController@birthdaysThisMonth');
    Route::get('human_resources/birthdays/next_month', 'HumanResourcesController@birthdaysNextMonth');
    Route::get('human_resources/birthdays/last_month', 'HumanResourcesController@birthdaysLastMonth');
});
