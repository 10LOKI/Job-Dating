<?php
namespace App\core;

class Validation
{
    public static function validateEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
    
    public static function required($value): bool
    {
        return !empty($value) || $value === '0';
    }
    
    public static function minLength(string $value, int $min): bool
    {
        return strlen($value) >= $min;
    }
}