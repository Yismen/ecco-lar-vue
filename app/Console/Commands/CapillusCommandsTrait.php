<?php

namespace App\Console\Commands;

trait CapillusCommandsTrait 
{  

    /**
     * Parse the distro list from the dainsys config file
     *
     * @return array
     */
    protected function distroList(): array
    {
        $list = config('dainsys.capillus-flash-distro') ?? 
            abort(404, "Invalid distro list. Set it up in the .env, separated by pipe (|).");

        return explode("|", $list);
    } 
}