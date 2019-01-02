<?php

namespace App\Http\ViewComposers;

use App\Role;
use App\User;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class AppComposer
{
    private $user;

    public function __construct()
    {
        $this->user = $this->user();
    }

    public function compose(View $view)
    {
        return $view->with([
            'logged' => auth()->check(),
            'user' => $this->user,
            'app_name' => ucwords(config('dainsys.app_name', 'Dainsys')),
            'client_name' => ucwords(config('dainsys.client_name', 'Dainsys\' Client')),
            'client_name_mini' => strtoupper(config('dainsys.client_name_mini', 'DAINSYS')),
            'settings' => $this->settings(),
            'color' => $this->color()
        ]);
    }

    private function user()
    {
        if (Auth::check()) {
            return User::with(['roles' => function ($query) {
                return $query->orderBy('name');
            }])
            ->with('profile')
            ->with('roles.menus')
            ->with('settings')
            ->find(Auth::id());
        }

        return null;
    }

    private function settings()
    {
        return $this->user && $this->user->settings ? json_decode($this->user->settings->data) : null;
    }

    private function color()
    {
        $settings = $this->settings();

        $skin = $settings && isset($settings->skin) ?
            explode('-', $settings->skin) :
            explode('-', config('dainsys.layout_color'));

        return is_array($skin) && count($skin) > 1 ?
            $skin[1] :
            $skin;
    }
}
