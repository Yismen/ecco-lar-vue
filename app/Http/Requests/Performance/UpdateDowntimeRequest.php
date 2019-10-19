<?php

namespace App\Http\Requests\Performance;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDowntimeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [            
            'date' => 'required|date|',
            'employee_id' => 'required|exists:employees,id',
            'campaign_id' => 'required|exists:campaigns,id',
            'login_time' => 'required|numeric|min:0|max:14',
            'downtime_reason_id' => 'required|exists:downtime_reasons,id',
            'reported_by' => 'required|exists:supervisors,name',
        ];
    }
}
