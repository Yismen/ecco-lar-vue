<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'employee_id' => $this->employee_id,
            'employee_name' => optional($this->employee)->full_name,
            'supervisor' => optional($this->employee->supervisor)->name,
            'date' => $this->date->format('Y-m-d'),
            'hours' => $this->hours,
        ];
    }
}
