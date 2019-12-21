<?php

namespace App\Http\Requests;

use App\Attendance;
use App\Rules\DateBetweenRule;
use App\Rules\DateCurrentOrOlderRule;
use App\Rules\DateNewerThanRule;
use App\Rules\UniqueInDBRule;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Unique;

class AttendanceRequest extends FormRequest
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
            'date' => [
                'required',
                'date',
                new DateBetweenRule(Carbon::now()->subDays(10), Carbon::now())
            ],
            // 'user_id' => 'required|exists:users,id',
            'employee_id' => 'required|exists:employees,id',
            'code_id' => [
                'required',
                'exists:attendance_codes,id',
                new UniqueInDBRule(
                    new Attendance(), ['user_id', 'employee_id', 'code_id', 'date']
                ) 
            ],
                       
        ];
    }
}
