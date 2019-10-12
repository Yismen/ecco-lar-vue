<?php

namespace App\Http\Requests\Holiday;

use App\Holiday;
use Illuminate\Foundation\Http\FormRequest;

class UpdateHolidayRequest extends FormRequest
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
        $exists = Holiday::whereDate('date', request('date'))->first();
        $id =  $exists ? $exists->id : null;

        return [
            'date' => 'required|date|unique:holidays,date,' . $id . ',id',
            'name' => 'required|min:4|max:150'
        ];
    }
}
