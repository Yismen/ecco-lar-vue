<?php

namespace App\Http\Requests;

class GeneratePayrollsRequest extends Request
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
            'from' => 'required|date',
            'to' => 'required|date',
            'department' => 'required',
            'position' => 'required',
            'payment_type' => 'required'
        ];
    }
}
