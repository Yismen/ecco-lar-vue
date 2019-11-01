<?php

namespace App\Mail\Capillus;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

abstract class CapillusMailBase extends Mailable
{
    
    use Queueable, SerializesModels;

    public $capillus_file_name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $distro, $filename)
    {
        foreach ($distro as $recipient) {
            $this->to($recipient);
        }       

        $this->capillus_file_name = $filename;  
    }
}