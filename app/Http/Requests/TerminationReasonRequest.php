<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TerminationReasonRequest extends Request
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
        $id = array_has(Request::route()->parameters(), 'termination_reasons') ? 
            Request::route()->parameters()['termination_reasons']->id : 
            null;

        return [
            'reason' => 'required|unique:termination_reasons,reason,'.$id,
            'description' => 'min:5',
        ];
    }
}
