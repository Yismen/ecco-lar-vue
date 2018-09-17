<?php

namespace App\Http\Traits;

use App\Hour;

trait HoursImportTrait
{
    private function saveDataToDB($rows)
    {
        foreach ($rows as $data) {
            $exists = Hour::where('unique_id', '=', $data['unique_id'])->first();

            if ($exists) {
                $exists->delete();
            }
            Hour::create($data);
        }
    }
}
