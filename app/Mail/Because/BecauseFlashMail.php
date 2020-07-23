<?php

namespace App\Mail\Because;

class BecauseFlashMail extends BecauseBaseMail
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
            ->subject("KNYC.E Flash Report - Because");
    }
}
