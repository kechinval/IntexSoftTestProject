<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class INN implements Rule
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
        $inn = (string)$value;
        if (strlen($inn) == 12) {
            $code11 = (($inn[0] * 7 + $inn[1] * 2 + $inn[2] * 4 + $inn[3] *10 +
                        $inn[4] * 3 + $inn[5] * 5 + $inn[6] * 9 + $inn[7] * 4 +
                        $inn[8] * 6 + $inn[9] * 8) % 11 ) % 10;
            $code12 = (($inn[0] * 3 + $inn[1] * 7 + $inn[2] * 2 + $inn[3] * 4 +
                        $inn[4] *10 + $inn[5] * 3 + $inn[6] * 5 + $inn[7] * 9 +
                        $inn[8] * 4 + $inn[9] * 6 + $inn[10]* 8) % 11 ) % 10;
            return $code11 == $inn[10] && $code12 == $inn[11];
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
        return 'INN validation error.';
    }
}
