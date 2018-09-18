<?php

namespace App\Listeners;

use Illuminate\Http\Request;
use App\Events\EditUserSettings;

class UpdateUserSettings
{
    private $request;

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
     * @param  EditUserSettings  $event
     * @return void
     */
    public function handle(EditUserSettings $event)
    {
        $event->user->app_setting->update(
            $event->user->settings
        );
    }
}
