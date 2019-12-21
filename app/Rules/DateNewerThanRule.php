<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class DateNewerThanRule implements Rule
{
    protected $days;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(int $days)
    {
        $this->days = $days;
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

        return $value >= Carbon::now()->addDays($this->days);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "Field {$this->attribute} can't be older than {$this->days} days!";
    }
}
