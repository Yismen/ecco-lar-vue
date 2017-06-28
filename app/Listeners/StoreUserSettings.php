<?php

namespace App\Listeners;

use App\AppSetting;
use Illuminate\Http\Request;
use App\Events\CreateUserSettings;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class StoreUserSettings
{
    protected $request;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  CreateUserSettings  $event
     * @return void
     */
    public function handle(CreateUserSettings $event)
    {
        $event->user->app_setting()->save(
            new AppSetting(
                $event->user->settings
            )
        );
    }
}
