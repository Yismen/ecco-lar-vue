<?php

namespace App\Mail\Political;

class PoliticalFlashMail extends PoliticalMailBase
{    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->defaultBuild("Political Hourly Flash");
    }
}
