<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class OGRN implements Rule
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
        $ogrn = (string)($value);
        if (preg_match('#([\d]{13})#', $ogrn, $m)) {
            $code1 = substr($m[1], 0, 12);
            $code2 = floor($code1 / 11) * 11;
            $code = ($code1 - $code2) % 10;
            if ($code == $m[1][12]) return $m[1];
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
        return 'OGRN validation error.';
    }
}
