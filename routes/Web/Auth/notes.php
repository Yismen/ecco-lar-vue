<?php

Route::get('notes/trashed', ['as' => 'notes.trashed', 'uses' => 'NotesAdminController@trashedNotes']);
Route::get('notes/restore/{slug}', ['as' => 'notes.restore', 'uses' => 'NotesAdminController@restoreNotes']);
Route::resource('notes', 'NotesAdminController');
