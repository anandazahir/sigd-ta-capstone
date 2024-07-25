<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UniqueArrayValueFoto implements Rule
{
    protected $otherField;
    protected $otherFieldValue;

    /**
     * Create a new rule instance.
     *
     * @param string $otherField
     */
    public function __construct($otherField)
    {
        $this->otherField = $otherField;
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
        $this->otherFieldValue = request($this->otherField);

        if (is_array($this->otherFieldValue) && count($this->otherFieldValue) !== count(array_unique($this->otherFieldValue))) {
            return false;
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
        return 'Nilai pada :attribute harus unik.';
    }
}
