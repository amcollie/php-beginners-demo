<?php

declare(strict_types=1);

namespace Core;

class Validator
{
    /**
     * Check if a string is within a specific length range
     *
     * @param string  The string to check
     * @param int  The minimum length
     * @param int  The maximum length
     * @return bool Whether the string is within the specified length range
     */
    public static function string(string $value, int $min = 1, int $max = PHP_INT_MAX): bool
    {
        $value = trim($value);

        return strlen($value) >= $min && strlen($value) <= $max;
    }

    /**
     * Check if a value is a valid email address
     *
     * @param string $value The value to check
     * @return bool Whether the value is a valid email address
     */
    public static function email(string $value): bool
    {
        return boolval(filter_var($value, FILTER_VALIDATE_EMAIL));
    }

    public static function password(string $value, string $hash): bool
    {
        return password_verify($value, $hash);
    }
}