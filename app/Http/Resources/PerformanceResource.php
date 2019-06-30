<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PerformanceResource extends JsonResource
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
            'employee_name' => optional($this->employee)->full_name,
            'hire_date' => optional($this->employee)->hire_date->format('Y-m-d'),
            'status' => $this->employee->status,
            'supervisor_employee' => optional($this->employee->supervisor)->name,
            'project_employee' => optional($this->employee->project)->name,
            'department' => optional(optional($this->employee->position)->department)->name,
            'site' => optional($this->employee->site)->name,
            'campaign' => optional($this->campaign)->name,
            'supervisor_performance' => optional($this->supervisor)->name,
            'project_performance' => optional(optional($this->campaign)->project)->name,
            'source' => optional(optional($this->campaign)->source)->name,
            'login_time' => $this->login_time,
            'production_time' => $this->production_time,
            'talk_time' => $this->talk_time,
            'billable_hours' => $this->billable_hours,
            'contacts' => $this->contacts,
            'calls' => $this->calls,
            'sales' => $this->transactions,
            'revenue' => $this->revenue,
            'dontime_reason' => optional($this->downtimeReason)->name,
            'reported_by' => $this->reported_by,
        ];
    }
}
