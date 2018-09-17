<?php

namespace App\Http\Traits;

use App\PayrollDiscount;

trait PayrollDiscountsTrait
{
    private function saveDataToDB($rows)
    {
        foreach ($rows as $data) {
            PayrollDiscount::create($data);
        }
    }
}
