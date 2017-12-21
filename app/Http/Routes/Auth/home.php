<?php


/**
 * ------------------------------------------
 * Home Routes                              |
 * ------------------------------------------
 */
Route::get('/home', function(){
    return Auth::user()->rolesList;
});