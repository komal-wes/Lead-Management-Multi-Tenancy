<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Stancl\Tenancy\Database\Models\Domain;

class UniqueDomain implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $urlWithDomain = $value . '.' . config('app.domain');
        if (Domain::where('domain', $urlWithDomain)->exists()) {
            $fail('The "'.$value.'" domain is not available, Please choose another.');
        }        
    }
}
