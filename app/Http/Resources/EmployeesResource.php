<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeesResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "first_name" => $this->first_name,
            "second_first_name" => $this->second_first_name,
            "last_name" => $this->last_name,
            "second_last_name" => $this->second_last_name,
            "full_name" => $this->full_name,
            "hire_date" => $this->hire_date->format('Y-m-d'),
            "personal_id" => $this->personal_id,
            "passport" => $this->passport,
            "date_of_birth" => $this->date_of_birth->format('Y-m-d'),
            "cellphone_number" => $this->cellphone_number,
            "secondary_phone" => $this->secondary_phone,
            "site" => optional($this->site)->name,
            "project" => optional($this->project)->name,
            "position" => optional($this->position)->name,
            "salary" => optional($this->position)->salary,
            "salary_type" => optional(optional($this->position)->payment_type)->name,
            "pay_per_hours" => optional($this->position)->pay_per_hours,
            "department" => optional(optional($this->position)->department)->name,
            "supervisor" => optional($this->supervisor)->name,
            "gender" => optional($this->gender)->name,
            "marital" => optional($this->marital)->name,
            "ars" => optional($this->ars)->name,
            "afp" => optional($this->afp)->name,
            "nationality" => optional($this->nationality)->name,
            "has_kids" => $this->has_kids,
            "photo" => $this->photo,
            "active" => $this->active,
            "status" => $this->status,
            "punch" => optional($this->punch)->punch,
            "account_number" => optional($this->bankAccount)->account_number,
            "is_vip" => $this->isVip,
            "is_universal" => $this->isUniversal,
        ];
    }
}
