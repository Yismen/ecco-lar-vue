<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PayrollImportFromExcelRequest extends Request
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
            'payroll_file.*' => 'required|file|mimes:xls,xlsx,csv',
        ];
    }

    public function messages()
    {
        return [
            'payroll_file.*' => 'Este campo es requerido'
        ];
    }
}
