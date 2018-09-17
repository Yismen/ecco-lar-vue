<?php

namespace App\Http\Traits;

use App\PayrollAdditional;

trait PayrollAdditionalsTrait
{
    private function saveDataToDB($rows)
    {
        foreach ($rows as $data) {
            PayrollAdditional::create($data);
        }
    }
}
