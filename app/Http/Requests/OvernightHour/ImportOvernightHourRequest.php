<?php

namespace App\Http\Requests\OvernightHour;

use App\Rules\FileExtensionRule;
use App\Rules\FilenameStartsWithRule;
use Illuminate\Foundation\Http\FormRequest;

class ImportOvernightHourRequest extends FormRequest
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
            '_file_' => [
                'required',
                'file',
                // 'mimes:xls,xlsx',
                'max:3000',
                new FilenameStartsWithRule('import_overnight_hours_'),
                new FileExtensionRule('xls|xlsx')
            ],
        ];
    }
}
