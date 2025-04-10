<?php

namespace Refaltor\PestPmmpTests\traits;

trait ValidatorTrait
{
    public function assertString(string $expected, string $actual): bool
    {
        return $actual === $expected;
    }

    public function assertNotEmptyString(string $value): bool
    {
        return trim($value) !== '';
    }

    public function assertContainsString(string $needle, string $haystack): bool
    {
        return str_contains($haystack, $needle);
    }

    public function assertStartsWith(string $prefix, string $string): bool
    {
        return str_starts_with($string, $prefix);
    }

    public function assertEndsWith(string $suffix, string $string): bool
    {
        return str_ends_with($string, $suffix);
    }

    public function assertRegexMatch(string $pattern, string $subject): bool
    {
        return preg_match($pattern, $subject) === 1;
    }

    public function assertLength(string $value, int $expectedLength): bool
    {
        return strlen($value) === $expectedLength;
    }

    public function assertMinLength(string $value, int $min): bool
    {
        return strlen($value) >= $min;
    }

    public function assertMaxLength(string $value, int $max): bool
    {
        return strlen($value) <= $max;
    }
}
