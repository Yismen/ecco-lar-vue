<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Position;
use Illuminate\Http\Request;

class PositionUnique implements Rule
{
    /**
     * Instance of App\Position
     *
     */
    protected $position;
    /**
     * An instance of Illuminate\Http\Request
     *
     */
    protected $request;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Position $position, Request $request)
    {
        $this->position = $position;
        $this->request = $request;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $value = ucfirst(strtolower(trim($value)));

        $exists = $this->position->where($attribute, '=', $value)
            ->where('department_id', '=', $this->request->department_id)
            ->first();

        if (!$exists || optional($this->position)->id == $exists->id) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be unique under this department.';
    }
}
