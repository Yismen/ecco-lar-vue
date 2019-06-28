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

    Route::get('performances/performance_data/last/{many}/months', 'Api\PerformancesController@performanceData');
    Route::get('performances/login_names', 'Api\PerformancesController@loginNames');
    Route::get('performances/campaigns', 'Api\PerformancesController@campaigns');
    Route::get('performances/employees', 'Api\PerformancesController@employees');
    Route::get('performances/downtimes', 'Api\PerformancesController@downtimes');
    Route::get('performances/downtime_reasons', 'Api\PerformancesController@downtimeReasons');

    Route::get('/blackhawk/de/management', 'Blackhawk\DE\ManagementController@dashboardData');
});
