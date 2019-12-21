<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class DateBetweenRule implements Rule
{
    protected $from;
    protected $value;
    protected $attribute;

    protected $to;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Carbon $from, Carbon $to = null)
    {
        $this->from = $from;    
        
        $this->to = $to != null ? $to : Carbon::now();
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
        $this->attribute = $attribute;
        
        $this->value = $value;
        
        return $value >= $this->from && $value <= $this->to;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "Field {$this->attribute} must be between {$this->from} and {$this->to}.";
    }
}
