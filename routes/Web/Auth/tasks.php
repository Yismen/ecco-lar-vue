<?php

Route::bind('task', function($id){
	return App\Task::whereId($id)
		->firstOrFail();
});
Route::resource('tasks', 'TasksController');