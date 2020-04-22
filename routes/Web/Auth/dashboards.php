<?php

Route::get('dashboards', 'Dashboards\DashboardController')->name('dashboards');

Route::get('dashboards/human_resources', 'Dashboards\HumanResourcesDashboardController@index')->name('human_resources_dashboard');

Route::get('dashboards/owner', 'Dashboards\OwnerDashboardController@index')->name('owner_dashboard');
Route::get('dashboards/admin', 'Dashboards\AdminDashboardController@index')->name('admin_dashboard');

Route::get('dashboards/default', 'Dashboards\DefaultDashboardController@index')->name('default_dashboard');