<?php

namespace App\Http\Requests\OvernightHour;

use App\OvernightHour;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateOvernightHourRequest extends FormRequest
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
    public function rules(): array
    {
        $dates = OvernightHour::where('employee_id', request('employee_id'))
            ->whereDate('date', request('date'))
            ->pluck('date')->map(function ($date) {
                return $date->format('Y-m-d');
            });

        return [
            'date' => [
                'required', 'date',
                Rule::notIn($dates)
            ],
            'employee_id' => 'required|exists:employees,id',
            'hours' => 'numeric|min:0|max:17'
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'date.not_in' => 'This Employee has hours for this Date',
        ];
    }
}
