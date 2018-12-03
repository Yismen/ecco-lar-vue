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
    Route::resource('positions', 'PositionsController');
    Route::resource('arss', 'ArsController')->only(['index', 'store']);
    Route::resource('afps', 'AfpsController')->only(['index', 'store']);
    Route::resource('banks', 'BanksController')->only(['index', 'store']);
    Route::resource('supervisors', 'SupervisorsController')->only(['index', 'store']);
    Route::resource('departments', 'DepartmentsController');
    Route::resource('nationalities', 'NationalitiesController');
    Route::resource('payment_frequencies', 'PaymentFrequenciesController');

    Route::get('/blackhawk/de/management', 'Blackhawk\DE\ManagementController@dashboardData');
});
