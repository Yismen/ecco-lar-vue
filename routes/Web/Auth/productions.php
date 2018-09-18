<?php

/**
 * productions Routes
 * ------------------------------------------------
 */
Route::resource('productions', 'ProductionsController', ['only' => ['index', 'create', 'store']]);
Route::get('productions/{date}', ['uses' => 'ProductionsController@show', 'as' => 'admin.productions.show']);
// Route::get('productions/show_date/{date}', ['as'=>'admin.productions.show_date', 'uses'=>'ProductionsController@show_date']);
// Route::get('productions/show_employee/{employee}', ['as'=>'admin.productions.show_employee', 'uses'=>'ProductionsController@show_employee']);

// Route::bind('productions', function($productions){
//  return App\Production::where('insert_date', $productions)
//         ->orderBy('name')
//      ->with('source')
//      ->get();
// });
