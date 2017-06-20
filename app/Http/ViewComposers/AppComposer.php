<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class AppComposer
{
    private $user;

    public function __construct()
    {
        $this->user = ! Auth::check() ? null : Auth::user()
                ->with(['roles'=>function($query){
                    return $query->orderBy('display_name');
                }])
                ->with('profile')
                ->first();
    }

    public function compose(View $view)
    {
        return $view->with([
            'logged' => auth()->check(),  
            'user' => $this->user,
            'menu' => null,
            'layout_color' => config('dainsys.layout_color')
        ]);
    }
}