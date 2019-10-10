<?php

namespace App\Http\Requests\OvernightHour;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOvernightHourRequest extends FormRequest
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
            'hours' => 'numeric|min:0|max:14'
        ];
    }
}
