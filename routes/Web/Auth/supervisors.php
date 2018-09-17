<?php

Route::bind('supervisor', function ($id) {
    return App\Supervisor::whereId($id)
        ->with(['employees' => function ($query) {
            return $query->orderBy('first_name')->with('position.department');
        }])
        ->with(['department' => function ($query) {
            return $query->orderBy('department');
        }])
        ->firstOrFail();
});

Route::resource('supervisors', 'SupervisorsController');
