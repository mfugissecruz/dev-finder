<?php

namespace App\Helper;

use InvalidArgumentException;

class ValidateType
{
    /**
     * Validate that the value is a float.
     *
     * @throws InvalidArgumentException
     */
    public static function float(mixed $value): float
    {
        if (! is_float($value)) {
            throw new InvalidArgumentException('The given value is not a valid float.');
        }

        return $value;
    }

    /**
     * Validate that the value is an integer.
     *
     * @throws InvalidArgumentException
     */
    public static function integer(mixed $value): int
    {
        if (! is_int($value)) {
            throw new InvalidArgumentException('The given value is not a valid integer.');
        }

        return $value;
    }

    /**
     * Validate that the value is a string or null.
     *
     * @throws InvalidArgumentException
     */
    public static function nullableString(mixed $value): ?string
    {
        if (! is_null($value) && ! is_string($value)) {
            throw new InvalidArgumentException('The given value is not a valid string or null.');
        }

        return $value;
    }

    /**
     * Validate that the value is a string.
     *
     * @throws InvalidArgumentException
     */
    public static function string(mixed $value): string
    {
        if (! is_string($value)) {
            throw new InvalidArgumentException('The given value is not a valid string.');
        }

        return $value;
    }
}
