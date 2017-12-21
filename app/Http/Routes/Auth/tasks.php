<?php

/**
 * ===========================================================
 * Task
 */

Route::bind('tasks', function($id){
	return App\Task::whereId($id)
		->firstOrFail();
});
Route::resource('tasks', 'TasksController');