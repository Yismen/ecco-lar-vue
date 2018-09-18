<?php

/**
 * ===========================================================
 * Cards
 */
Route::bind('card', function ($card) {
    return App\Card::whereCard($card)
        ->with('employee')
        ->firstOrFail();
});
Route::resource('cards', 'CardsController');
