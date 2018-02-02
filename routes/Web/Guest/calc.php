<?php

Route::get('date_calc', ['as' => 'date_calc.index', 'uses' => 'DateCalcController@index']);
Route::get('date_calc/from_today', ['as' => 'date_calc.diff_from_today', 'uses' => 'DateCalcController@diffFromToday']);
Route::get('date_calc/range_diff', ['as' => 'date_calc.range_diff', 'uses' => 'DateCalcController@rangeDiff']);
