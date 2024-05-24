<?php

namespace App\Helper;

use InvalidArgumentException;

class IsString
{
    /**
     * Validate that the value is a string.
     *
     * @param mixed $value
     *
     * @return string
     *
     * @throws InvalidArgumentException
     */
    public static function validate(mixed $value): string
    {
        if (! is_string($value)) {
            throw new InvalidArgumentException('The given value is not a valid string.');
        }

        return $value;
    }
}
