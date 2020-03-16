<?php

namespace App\Mail\Capillus;

class CapillusCallTypeReportMail extends CapillusMailBase
{
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->defaultBuild("KNYC.E Calls Type Report");
    }
}
