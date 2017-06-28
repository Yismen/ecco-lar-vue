<?php

namespace App\Http\ViewComposers;

use App\User;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class AppComposer
{
    private $user;
    private $layout_color;
    private $layout;
    private $sidebar_mini;
    private $sidebar_collapse;

    public function __construct()
    {
        $this->user = $this->user();
        $this->setVars();
       
    }

    public function compose(View $view)
    {
        return $view->with([
            'logged' => auth()->check(),  
            'user' => $this->user,
            'menu' => null,
            'layout_color' => $this->layout_color,
            'layout' => $this->layout,
            'sidebar_mini' => $this->sidebar_mini,
            'sidebar_collapse' => $this->sidebar_collapse,
            'layouts' => [
                "default" => "Default Layout",    
                "fixed" => "Fixed Layout",    
                "layout-boxed" => "Boxed Layout",   
                "layout-top-nav" => "Top Nav Layout",  
            ],
            'layout_colors' => [
                'blue'   => 'Blue Skin',
                'black'  => 'Black Skin',
                'purple' => 'Purple Skin',
                'yellow' => 'Yellow Skin',
                'red'    => 'Red Skin',
                'green'  => 'Green Skin',
            ],
        ]);
    }

    public function user()
    {
        if (Auth::check()) {
            return User::with(['roles'=>function($query){
                return $query->orderBy('display_name');
            }])
            ->with('profile')
            ->with('app_setting')
            ->find(Auth::id());
        }
        
        return null;
    }

    private function setVars()
    {
        if ($this->user && $this->user->app_setting) {
            $this->layout_color = $this->user->app_setting->skin;
            $this->layout = $this->user->app_setting->layout;
            $this->sidebar_mini = $this->user->app_setting->mini ? 'sidebar-mini' : '';
            $this->sidebar_collapse = $this->user->app_setting->collapse ? 'sidebar-collapse' : '';
        } else {            
            $this->layout_color = config('dainsys.layout_color');
            $this->layout = config('dainsys.layout');
            $this->sidebar_mini = config('dainsys.sidebar_mini');
            $this->sidebar_collapse = config('dainsys.sidebar_collapse');
        }
    }
}