<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PayrollDiscountRequest extends Request
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
            'amount' => 'required|min:0',
            'concept_id' => 'required|exists:payroll_discount_concepts,id',
            'concept_id' => 'max:150',
        ];
    }
}
