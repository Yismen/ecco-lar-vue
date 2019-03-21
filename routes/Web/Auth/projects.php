<?php

Route::bind('project', function ($id) {
    return App\Project::findOrFail($id);
});

Route::resource('projects', 'ProjectsController');
