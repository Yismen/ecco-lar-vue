<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileExtensionRule implements Rule
{
    protected $extensions = [];

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($extensions)
    {
        $this->extensions = is_array($extensions) ?
            $extensions : explode('|', $extensions);
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
        if (request()->hasFile($attribute) && count($this->extensions) > 0) {
            return in_array($value->getclientOriginalExtension(), $this->extensions);
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "File must be of extenxions " . implode('|', $this->extensions);
    }
}
