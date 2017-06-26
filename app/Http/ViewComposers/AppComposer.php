<?php

namespace App\Http\ViewComposers;

use App\User;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class AppComposer
{
    private $user;
    private $layout_color;
    private $sidebar_mini;
    private $sidebar_collapse;

    public function __construct()
    {
        $this->user = $this->user();
        $this->layout_color = $this->userHaveSetting('layout_color');
        $this->sidebar_mini = $this->userHaveSetting('sidebar_mini');
        $this->sidebar_collapse = $this->userHaveSetting('sidebar_collapse');
    }

    public function compose(View $view)
    {
        return $view->with([
            'logged' => auth()->check(),  
            'user' => $this->user,
            'menu' => null,
            'layout_color' => $this->layout_color,
            'sidebar_mini' => $this->sidebar_mini,
            'sidebar_collapse' => $this->sidebar_collapse,
        ]);
    }

    public function user()
    {
        if (Auth::check()) {
            return User::with(['roles'=>function($query){
                return $query->orderBy('display_name');
            }])
            ->with('profile')
            ->with('settings')
            ->find(Auth::id());
        }
        
        return null;
    }

    private function userHaveSetting($name)
    {
        $output = null;
        if ($this->user && $this->user->settings) {
            foreach ($this->user->settings as $setting) {
                if ($setting->key == $name) {
                    $output = $setting->value;
                    break;
                }
            }
        }

        return $output ? $output : config('dainsys.'.$name);    
    }
}