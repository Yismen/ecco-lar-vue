<?php

Route::bind('note', function ($slug) {
    return App\Note::whereSlug($slug)->firstOrFail();
});

Route::get('notes/trashed', ['as' => 'notes.trashed', 'uses' => 'NotesAdminController@trashedNotes']);
Route::get('notes/restore/{slug}', ['as' => 'notes.restore', 'uses' => 'NotesAdminController@restoreNotes']);
Route::resource('notes', 'NotesAdminController');
