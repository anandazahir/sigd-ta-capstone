<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class RequiredArrayValues implements Rule
{

    public function passes($attribute, $value)
    {
        if (!is_array($value) || empty($value)) {
            return false;
        }

        foreach ($value as $item) {
            if (is_array($item) || is_object($item)) {
                return false;
            }
            if (trim($item) === '') {
                return false;
            }
        }
        return true;
    }

    public function message()
    {
        return ':attribute tidak boleh memiliki nilai yang kosong.';
    }
}
