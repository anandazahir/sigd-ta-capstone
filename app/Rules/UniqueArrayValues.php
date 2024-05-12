<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UniqueArrayValues implements Rule
{
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        return count($value) === count(array_unique($value));
    }

    public function message()
    {
        return 'The values in :attribute must be unique.';
    }
}
