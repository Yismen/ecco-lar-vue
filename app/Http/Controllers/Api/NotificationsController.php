<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notification;
use Illuminate\Notifications\Notification as NotificationsNotification;
use Illuminate\Support\Facades\Cache;

class NotificationsController extends Controller
{
    public function unread()
    {
        return auth()->user()->unreadNotifications;
    }

    public function markAllAsRead()
    {
        foreach (auth()->user()->unreadNotifications as $notification) {
            $notification->markAsRead();
        }        
        
        Cache::flush();
        
        return auth()->user()->unreadNotifications()->get();
    }

    public function show(Notification $notification)
    {
        $notification->markAsRead();

        return $notification;
    }
}
