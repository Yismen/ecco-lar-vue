<?php

namespace App\Repositories\HumanResources;

interface HumanResourcesInterface
{
    public function __construct(bool $by_site = false);

    public function bySite();

    public function setup($type);

    public function count();

    public function list();

    public function query($status, $site = '%');
}
