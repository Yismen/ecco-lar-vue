<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'supervisor_id' => optional($this->supervisor)->id,
            'site_id' => optional($this->site)->id,
            'punch' => optional($this->punch)->punch,
        ];
    }
}
