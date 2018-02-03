<?php

Route::get('/{path}', function () {
    $user = Auth::user();
    if ($user && !$user->profile) {
        return redirect()->route('admin.profiles.create');
    }

    return view('welcome');
})->where('path', '(admin|home|)');
