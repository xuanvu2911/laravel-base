<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class StrongPassword implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $value = trim($value);
        if (!preg_match('/^(?=.*[\W])(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{5,20}$/', $value)) {
            $fail(':attribute phải bao gồm chữ in hoa, chữ thường, số và ký tự đặc biệt.');
        }
    }
}
