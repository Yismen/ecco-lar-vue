<?php

Route::get('sites_dashboard', 'Dashboards\SiteOverviewController@index')->name('sites-overview-dashboard');
Route::get('dashboards', 'Dashboards\DashboardController')->name('dashboards');
