<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class RequiredArrayValuesFoto implements Rule
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
        $otherFieldValue = request($this->otherField);
        if (!is_array($otherFieldValue) || empty($otherFieldValue)) {
            return false; // Validation fails if this field is empty
        }
        foreach ($otherFieldValue as $item) {
            if (empty($item)) {
                return false;
            }
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
        return 'The :attribute must have non-empty values.';
    }
}
