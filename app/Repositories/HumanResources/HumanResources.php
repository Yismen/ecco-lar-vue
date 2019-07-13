<?php

namespace App\Repositories\HumanResources;

/**
 * Human Resources Base State Class.
 */
class HumanResources
{
    protected $by_site;

    protected $results = [];

    public function __construct(bool $by_site = false)
    {
        $this->by_site = $by_site;
    }

    public function bySite()
    {
        $this->by_site = true;

        return $this;
    }
}
