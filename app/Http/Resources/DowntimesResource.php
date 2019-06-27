<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DowntimesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'unique_id' => $this->unique_id,
            'date' => $this->date,
            'employee_id' => $this->employee_id,
            'campaign' => optional($this->campaign)->name,
            'project_performance' => optional($this->campaign->project)->name,
            'employee_name' => optional($this->employee)->full_name,
            'login_time' => $this->login_time,
        ];
    }
}
