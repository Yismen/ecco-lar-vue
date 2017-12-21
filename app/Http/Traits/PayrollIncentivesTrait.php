<?php

namespace App\Http\Traits;

use App\PayrollIncentive;

trait PayrollIncentivesTrait
{
    private function saveDataToDB($rows)
    {
        foreach ($rows as $data) {
            PayrollIncentive::create($data);
        }
    }
}