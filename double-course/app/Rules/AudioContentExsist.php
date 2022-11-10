<?php

namespace App\Rules;

use App\Models\AffirmationCategory;
use App\Models\AudioContent;
use Illuminate\Contracts\Validation\Rule;

class AudioContentExsist implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        return AudioContent::find($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Content id error';
    }
}
