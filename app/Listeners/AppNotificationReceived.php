<?php

namespace App\Listeners;

use App\Events\UserAppNotificationSent;
use Illuminate\Notifications\Events\NotificationSent;
use Illuminate\Support\Facades\Log;

class AppNotificationReceived
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NotificationSent  $event
     * @return void
     */
    public function handle(NotificationSent $event)
    {
        if ($event->channel == 'database') {
            event(new UserAppNotificationSent($event->notifiable, $event->response));
        }
    }
}
