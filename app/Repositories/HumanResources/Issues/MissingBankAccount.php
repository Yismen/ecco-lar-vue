<?php

namespace App\Repositories\HumanResources\Issues;

use App\Repositories\HumanResources\HumanResourcesInterface;
use App\Employee;

class MissingBankAccount implements HumanResourcesInterface
{
    public function setup()
    {
        return Employee::actives()
            ->doesntHave('bankAccount');
    }

    public function count()
    {
        return $this->setup()->count();
    }

    public function list()
    {
        return $this->setup()->get();
    }
}
