<?php

namespace App\Mail\Capillus;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CapillusLeadsReportMail extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to('yjorge@eccocorpbpo.com')
            ->view('emails.capillus-leads', ['instance' => Carbon::now()->format("Ymd_His")])
            ->subject("Ecco - Capillus leads file");
    }
}
