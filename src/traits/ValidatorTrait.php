<?php

namespace Refaltor\PestPmmpTests\traits;

use InvalidArgumentException;
use LengthException;

trait ValidatorTrait
{
    public function assertString(string $expected, string $actual): void
    {
        if ($actual !== $expected) {
            throw new InvalidArgumentException("Expected '$expected', but got '$actual'.");
        }
    }

    public function assertNotEmptyString(string $value): void
    {
        if (trim($value) === '') {
            throw new InvalidArgumentException("String is empty.");
        }
    }

    public function assertContainsString(string $needle, string $haystack): void
    {
        if (!str_contains($haystack, $needle)) {
            throw new InvalidArgumentException("The string '$haystack' does not contain '$needle'.");
        }
    }

    public function assertStartsWith(string $prefix, string $string): void
    {
        if (!str_starts_with($string, $prefix)) {
            throw new InvalidArgumentException("The string '$string' does not start with '$prefix'.");
        }
    }

    public function assertEndsWith(string $suffix, string $string): void
    {
        if (!str_ends_with($string, $suffix)) {
            throw new InvalidArgumentException("The string '$string' does not end with '$suffix'.");
        }
    }

    public function assertRegexMatch(string $pattern, string $subject): void
    {
        if (preg_match($pattern, $subject) !== 1) {
            throw new InvalidArgumentException("The string '$subject' does not match the pattern '$pattern'.");
        }
    }

    public function assertLength(string $value, int $expectedLength): void
    {
        if (strlen($value) !== $expectedLength) {
            throw new LengthException("Expected length '$expectedLength', but got " . strlen($value) . ".");
        }
    }

    public function assertMinLength(string $value, int $min): void
    {
        if (strlen($value) < $min) {
            throw new LengthException("String length must be at least '$min', but got " . strlen($value) . ".");
        }
    }

    public function assertMaxLength(string $value, int $max): void
    {
        if (strlen($value) > $max) {
            throw new LengthException("String length must be at most '$max', but got " . strlen($value) . ".");
        }
    }

    // Nouvelle méthode pour vérifier si une valeur est une instance d'une classe donnée
    public function assertIsInstanceOf(object $object, string $className): void
    {
        if (!$object instanceof $className) {
            throw new InvalidArgumentException("Expected instance of '$className', but got " . get_class($object) . ".");
        }
    }

    // Nouvelle méthode pour vérifier si une valeur est de type booléen
    public function assertIsBool($value): void
    {
        if (!is_bool($value)) {
            throw new InvalidArgumentException("Expected a boolean, but got " . gettype($value) . ".");
        }
    }

    // Nouvelle méthode pour vérifier si une valeur est un tableau
    public function assertIsArray($value): void
    {
        if (!is_array($value)) {
            throw new InvalidArgumentException("Expected an array, but got " . gettype($value) . ".");
        }
    }

    // Nouvelle méthode pour vérifier si une valeur est un entier
    public function assertIsInt($value): void
    {
        if (!is_int($value)) {
            throw new InvalidArgumentException("Expected an integer, but got " . gettype($value) . ".");
        }
    }

    // Nouvelle méthode pour vérifier que deux valeurs sont égales
    public function assertEquals($expected, $actual): void
    {
        if ($expected !== $actual) {
            throw new InvalidArgumentException("Expected '$expected', but got '$actual'.");
        }
    }

    // Nouvelle méthode pour vérifier que la valeur est vide
    public function assertEmpty($value): void
    {
        if (!empty($value)) {
            throw new InvalidArgumentException("Expected an empty value, but got '$value'.");
        }
    }

    // Nouvelle méthode pour vérifier que la valeur n'est pas vide
    public function assertNotEmpty($value): void
    {
        if (empty($value)) {
            throw new InvalidArgumentException("Expected a non-empty value, but got an empty one.");
        }
    }
}
