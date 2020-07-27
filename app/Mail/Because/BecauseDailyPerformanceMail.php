<?php

namespace App\Mail\Because;

class BecauseDailyPerformanceMail extends BecauseMailBase
{
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('yjorge@eccocorpbpo.com', 'Yisme Jorge')
            ->bcc('yjorge@eccocorpbpo.com')
            ->view('emails.capillus')
            ->attachFromStorage($this->temporary_mail_attachment)
            ->subject("Kipany - Because Daily Performance Report");
    }
}
