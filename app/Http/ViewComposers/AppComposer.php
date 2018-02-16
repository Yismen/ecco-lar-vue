<?php

namespace App\Http\ViewComposers;

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
            'menu' => null,
            'settings' => $this->user->settings ? json_decode($this->user->settings->data) : null
        ]);
    }

    public function user()
    {
        if (Auth::check()) {
            return User::with(['roles' => function ($query) {
                return $query->orderBy('display_name');
            }])
            ->with('profile')
            ->with('settings')
            ->find(Auth::id());
        }

        return null;
    }
}
