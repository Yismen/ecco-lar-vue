<?php

namespace App\Mail\Capillus;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

abstract class CapillusMailBase extends Mailable
{
    
    use Queueable, SerializesModels;

    public $capillus_file_name;

    public $report_name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $distro, $filename, $report_name)
    {     

        $this->capillus_file_name = $filename;  
        $this->report_name = $report_name;

        
        foreach ($distro as $recipient) {
            $this->to($recipient);
        }  
    }

    public function defaultBuild($subject)
    {        
        return $this
            ->from('yjorge@eccocorpbpo.com', 'Yisme Jorge')
            ->bcc('yjorge@eccocorpbpo.com')
            ->view('emails.capillus')
            ->attachFromStorage($this->capillus_file_name)
            ->subject($subject);
    }
}