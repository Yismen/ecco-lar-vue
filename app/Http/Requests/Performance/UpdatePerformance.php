<?php

namespace App\Http\Requests\Performance;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePerformance extends FormRequest
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
          'date' => 'required|date',
          'employee_id' => 'required|exists:employees,id',
          'supervisor_id' => 'required|exists:supervisors,id',
          'login_time' => 'required|numeric|min:0|max:14',
          'production_time' => 'required|numeric|min:0|max:14',
          'transactions' => 'required|numeric',
          'revenue' => 'required|numeric',          
          'campaign_id' => 'required|exists:campaigns,id',

        ];
    }
}
