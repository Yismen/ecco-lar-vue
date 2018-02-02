<?php

Route::bind('note', function($slug) {
    return App\Note::whereSlug($slug)->firstOrFail();
});

Route::get('notes/trashed', ['as'=>'admin.notes.trashed', 'uses'=>'NotesAdminController@trashedNotes']);
Route::get('notes/restore/{slug}', ['as'=>'admin.notes.restore', 'uses'=>'NotesAdminController@restoreNotes']);
Route::resource('notes', 'NotesAdminController');