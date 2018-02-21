<?php

Route::bind('contact', function ($id) {
	return App\Contact::findOrFail($id);
});

Route::resource('contacts', 'User\ContactsController', ['except'=> ['show']]);
