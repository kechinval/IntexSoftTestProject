<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class SNILS implements Rule
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
        $snils = (int)$value;
        $control = substr($snils, -2);
        $snils = substr($snils, 0, 9);
        if($snils < "001001998")
        {
            return false;
        }
        $result = 0;
        $total = strlen($snils);
        for($i = 0; $i < $total; $i++)
        {
            $result += ($total - $i) * $snils[$i];
        }
        if($result == 100 || $result == 101) 
            $result = "00";
        if($result > 101) 
            $result %= 101;
        if($result == $control) 
            return true;
        else 
            return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'SNILS validation error.';
    }
}
