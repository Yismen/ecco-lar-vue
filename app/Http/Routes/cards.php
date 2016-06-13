<?php



/**
 * ===========================================================
 * Cards
 */
Route::bind('cards', function($card){
	return App\Card::whereCard($card)
		->with('employee')
		->firstOrFail();
});
Route::resource('cards', 'CardsController');




