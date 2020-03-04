<?php

namespace App\Mail\Capillus;

class CapillusLeadsReportMail extends CapillusMailBase
{
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->defaultBuild("Ecco - Capillus leads file");
    }
}
