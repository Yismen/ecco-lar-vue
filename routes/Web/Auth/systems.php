<?php

Route::bind('system', function ($id) {
    return App\System::whereId($id)
        // ->with('departments')
        // ->with('maritals')
        // ->with('positions')
        // ->with('genders')
        // ->with('addresses')
        ->firstOrFail();
});

Route::resource('systems', 'SystemsController');

// Route::post('systems/updateAddress/{systems}', [
// 	'as'=>'systems.updateAddress',
// 	'uses'=>'systemsController@updateAddress',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['systems_editor'],
// ]);

// Route::post('systems/updatePhoto/{systems}', [
// 	'as'=>'systems.updatePhoto',
// 	'uses'=>'systemsController@updatePhoto',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['systems_editor'],
// ]);

// /**
//  * systems index route
//  */
// Route::get('systems', [
// 	'as'=>'systems.index',
// 	'uses'=>'systemsController@index',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['systems_viewer'],
// ]);

// /**
//  * systems create route
//  */
// Route::get('systems/create', [
// 	'as'=>'systems.create',
// 	'uses'=>'systemsController@create',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['systems_editor'],
// ]);

// /**
//  * systems store route
//  */
// Route::post('/systems', [
// 	'as'=>'systems.store',
// 	'uses'=>'systemsController@store',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['systems_editor'],
// ]);

// Route::bind('systems', function($id){
// 	return App\System::whereId($id)
// 		// ->with('departments')
// 		// ->with('maritals')
// 		// ->with('positions')
// 		// ->with('genders')
// 		// ->with('addresses')
// 		->firstOrFail();
// });

// // Route::resource('systems', 'systemsController', [

// // ]);

// /**
//  * systems show route
//  */
// Route::get('systems/{systems}', [
// 	'as'=>'systems.show',
// 	'uses'=>'systemsController@show',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['systems_viewer'],
// ]);

// /**
//  * systems edit route
//  */
// Route::get('/systems/{systems}/edit', [
// 	'as'=>'systems.edit',
// 	'uses'=>'systemsController@edit',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['systems_editor'],
// ]);

// /**
//  * systems update route
//  */
// Route::put('/systems/{systems}', [
// 	'as'=>'systems.update',
// 	'uses'=>'systemsController@update',
// 	'middleware'=>['auth','authorize'],
// 	// 'roles'=>['administrator'],
// 	'permissions'=>['systems_editor'],
// ]);

// /**
//  * systems destroy route
//  */
// // Route::delete('/systems/{systems}', [
// // 	'as'=>'systems.destroy',
// // 	'uses'=>'systemsController@destroy',
// // 	'middleware'=>['auth','authorize'],
// // 	// 'roles'=>['administrator'],
// // 	'permissions'=>['systems_editor'],
// // ]);
