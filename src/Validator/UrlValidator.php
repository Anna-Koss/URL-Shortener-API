<?php

namespace App\Validator;

class UrlValidator implements ValidatorInterface
{

    public function validate(mixed $validatedValue): bool
    {
        return (bool) filter_var($validatedValue, FILTER_VALIDATE_URL);
    }
}