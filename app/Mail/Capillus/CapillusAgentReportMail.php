<?php

namespace App\Mail\Capillus;

class CapillusAgentReportMail extends CapillusMailBase
{    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->defaultBuild("KNYC.E Agent Report");
    }
}
