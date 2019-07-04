<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->group(function () {
    Route::get('/user', 'Api\UserController@index');
    Route::resource('employee', 'Api\EmployeeController')->except(['create', 'edit']);
    Route::resource('positions', 'PositionsController')->only(['index', 'create', 'store']);
    Route::resource('arss', 'ArsController')->only(['index', 'store']);
    Route::resource('afps', 'AfpsController')->only(['index', 'store']);
    Route::resource('banks', 'BanksController')->only(['index', 'store']);
    Route::resource('supervisors', 'SupervisorsController')->only(['index', 'store']);
    Route::resource('departments', 'DepartmentsController');
    Route::resource('nationalities', 'NationalitiesController')->only('store');
    Route::resource('payment_frequencies', 'PaymentFrequenciesController');

    Route::get('performances/performance_data/last/{many}/months', 'Api\Performances\PerformancesController@data');
    Route::get('performances/downtimes', 'Api\Performances\PerformancesController@downtimes');
    Route::get('performances/downtime_reasons', 'Api\Performances\DowntimesController@reasons');
    Route::get('performances/employees', 'Api\Performances\DowntimesController@employees');
    Route::get('performances/campaigns', 'Api\Performances\CampaignsController@list');
    Route::get('performances/login_names', 'Api\Performances\EmployeesController@loginNames');
    Route::get('performances/supervisors', 'Api\Performances\SupervisorsController@list');
    Route::get('performances/supervisors/actives', 'Api\Performances\SupervisorsController@actives');

    Route::get('/blackhawk/de/management', 'Blackhawk\DE\ManagementController@dashboardData');
});
