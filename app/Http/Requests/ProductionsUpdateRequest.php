<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProductionsUpdateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->hasRole(['owner', 'admin']) ||
            auth()->user()->can(['update_production']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'in_time' => 'required|date_format:Y-m-d H:i:s',
            'production_hours'=>'required|numeric|min:0.1|max:16',
            'break_time'=>'numeric|min:0|max:160',
            'downtime'=>'numeric|min:0|max:8',
        ];
    }
}
