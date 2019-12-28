<?php

namespace App\Mail\Capillus;

class CapillusAgentCallDataDumpEmail extends CapillusMailBase
{
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->defaultBuild("KNYC.E MTD Agent Call Data Dump");
    }
}
