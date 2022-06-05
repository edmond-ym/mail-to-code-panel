<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ConfirmPrivateCodeMatch implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($privateCode)
    {
        $this->privateCode=$privateCode;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $confirmPrivateCode)
    {
        return $this->privateCode==$confirmPrivateCode;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Private Code Not Match';
    }
}
