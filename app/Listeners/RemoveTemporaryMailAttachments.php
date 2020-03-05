<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Support\Facades\Storage;

class RemoveTemporaryMailAttachments
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
        if (array_has($event->data, 'temporary_mail_attachment') && Storage::exists($event->data['temporary_mail_attachment'])) {
            Storage::delete($event->data['temporary_mail_attachment']);
        }
    }
}
