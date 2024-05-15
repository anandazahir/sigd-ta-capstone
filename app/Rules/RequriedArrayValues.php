<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class RequriedArrayValues implements Rule
{
    public function __construct()
    {
        //
    }

    public function passes($attribute, $values)
    {
        // Menyaring nilai kosong dari array
        $nonEmptyValues = array_filter($values);

        // Memeriksa apakah terdapat nilai kosong
        if (count($nonEmptyValues) !== count($values)) {
            // Jika terdapat nilai kosong, buat pesan error
            $errorMessage = 'Harap isi semua nilai dalam array.';

            // Mengembalikan array error
            return ['required' => $errorMessage];
        }

        // Jika semua nilai tidak kosong, kembalikan true
        return true;
    }

    public function message()
    {
        return 'The values in :attribute must be required.';
    }
}
