<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginNameResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'employee_id' => $this->employee_id,
            'employee_name' => optional($this->employee)->full_name,
            'login' => $this->login,
            'supervisor_id' => optional($this->employee->supervisor)->id
        ];
    }
}
