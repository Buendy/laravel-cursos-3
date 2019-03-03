<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class StrengthPassword implements Rule
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
        if ($value){
            return true;
        }

        $success = false;

        $length = strlen($value) >= 8;
        $lowercase = preg_match('@[a-z]@', $value);
        $uppercase = preg_match('@[A-Z]@');
        $number = preg_match('@[0-9]@');

        if($lowercase && $uppercase && $number && $length){
            $success = true;
        }

        return $success;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('app.profile.index.rule_password');
    }
}
