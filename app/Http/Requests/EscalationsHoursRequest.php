<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EscalationsHoursRequest extends Request
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
            'user_id' => 'required|exists:users,id',
            'client_id' => 'required|exists:escal_clients,id',
            'date' => 'required|date',
            'entrance' => 'required|date_format:H:i',
            'out' => 'required|date_format:H:i|after:entrance',
            'break' => 'required|integer|min:0|max:300',
        ];
    }
}
