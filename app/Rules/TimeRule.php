<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class TimeRule implements ValidationRule
{
    private ?string $minTime = null;
    private ?string $maxTime = null;

    public function __construct(?string $minTime = null, ?string $maxTime = null)
    {
        $this->minTime = $minTime;
        $this->maxTime = $maxTime;
    }

    /**
     * Run the validation rule.
     *
     * @param Closure(string, ?string=): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Validate time format
        if (!preg_match('/^([0-1][0-9]|2[0-3]):[0-5][0-9]$/', $value)) {
            $fail('The :attribute is not a valid time (HH:MM).')->translate();
            return;
        }

        // Check minimum time
        if ($this->minTime && strtotime($value) < strtotime($this->minTime)) {
            $fail('The :attribute must be at least ' . $this->minTime . '.')->translate();
        }

        // Check maximum time
        if ($this->maxTime && strtotime($value) > strtotime($this->maxTime)) {
            $fail('The :attribute must not exceed ' . $this->maxTime . '.')->translate();
        }
    }
}
