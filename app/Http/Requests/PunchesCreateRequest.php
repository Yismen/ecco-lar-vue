<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PunchesCreateRequest extends FormRequest
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
            'punch' => 'required|min:4|max:90|unique:punches,punch',
            'employee_id' => 'required|exists:employees,id|unique:punches,employee_id',
        ];
    }
}
