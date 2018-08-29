<?php

Route::get('notes', 'NotesController@index')->name('notes.index');

// Route::group(['prefix' => 'api'], function () {
//     Route::post('notes/search', 'NotesController@search');
//     Route::post('notes', 'NotesController@index');
//     Route::get('notes/{id}', 'NotesController@show');
// });
