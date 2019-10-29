<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CapillusFlashMail extends Mailable
{
    use Queueable, SerializesModels;

    public $capillus_file_name;


    public $distro;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $distro, $filename)
    {
        $this->distro = $distro;

        $this->capillus_file_name = $filename;            
        
    }
    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        foreach ($this->distro as $recipient) {
            $this->to($recipient);
        }

        return $this
            ->from('yjorge@eccocorpbpo.com', 'Yisme Jorge')
            ->bcc('yjorge@eccocorpbpo.com')
            ->view('emails.capillus-flash')
            ->attachFromStorage($this->capillus_file_name)
            ->subject("KNYC.E Flash Report");
    }
}
