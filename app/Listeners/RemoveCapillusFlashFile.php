<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Support\Facades\Storage;

class RemoveCapillusFlashFile
{
    use InteractsWithQueue;
    
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
     * @param  object  $event
     * @return void
     */
    public function handle(MessageSent $event)
    {
       $this->removeFileIfExists($event);
    }

    protected function removeFileIfExists(MessageSent $event)
    {
        if (array_has($event->data, 'capillus_file_name') && Storage::exists($event->data['capillus_file_name'])) {
            Storage::delete($event->data['capillus_file_name']);
        }
    }
}
