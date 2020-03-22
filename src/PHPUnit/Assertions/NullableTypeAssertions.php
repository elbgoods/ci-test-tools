<?php

namespace Elbgoods\CiTestTools\PHPUnit\Assertions;

use Illuminate\Foundation\Testing\Assert as PHPUnit;

trait NullableTypeAssertions
{
    /**
     * @param string|mixed|null $actual
     * @param string|null $message
     */
    public static function assertIsNullableString($actual, ?string $message = null): void
    {
        PHPUnit::assertTrue(
            is_null($actual) || is_string($actual),
            $message ?? "Failed to assert that \"{$actual}\" is type of null|string."
        );
    }

    /**
     * @param int|mixed|null $actual
     * @param string|null $message
     */
    public static function assertIsNullableInt($actual, ?string $message = null): void
    {
        PHPUnit::assertTrue(
            is_null($actual) || is_int($actual),
            $message ?? "Failed to assert that \"{$actual}\" is type of null|int."
        );
    }

    /**
     * @param float|mixed|null $actual
     * @param string|null $message
     */
    public static function assertIsNullableFloat($actual, ?string $message = null): void
    {
        PHPUnit::assertTrue(
            is_null($actual) || (is_numeric($actual) && (is_int($actual) || is_float($actual))),
            $message ?? "Failed to assert that \"{$actual}\" is type of null|float."
        );
    }

    /**
     * @param array|mixed|null $actual
     * @param string|null $message
     */
    public static function assertIsNullableArray($actual, ?string $message = null): void
    {
        PHPUnit::assertTrue(
            is_null($actual) || is_array($actual),
            $message ?? "Failed to assert that \"{$actual}\" is type of null|array."
        );
    }
}
