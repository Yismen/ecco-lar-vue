<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin()
    {
        $user = auth()->user();
        if ($user && !$user->profile) {
            return redirect()->route('admin.profiles.create');
        }

        return redirect()->route('admin.dashboards');
    }

    public function welcome()
    {
        return view('welcome');
    }

    public function markAllNotificationsAsReadForUser()
    {
        
        foreach (auth()->user()->unreadNotifications as $notification) {
            $notification->markAsRead();
        }
        
        Cache::flush();
        return redirect()->back();
    }
}
