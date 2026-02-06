<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniversityEmail implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!str_ends_with(strtolower($value), '@ksf.it.com')) {
            $fail('The :attribute must be a valid Kingsford University email address.');
        }
    }
}