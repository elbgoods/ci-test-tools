<?php

namespace Elbgoods\CiTestTools\PHPUnit\Assertions;

use PHPUnit\Framework\Assert as PHPUnit;

trait NullableTypeAssertions
{
    /**
     * @param string|mixed|null $actual
     * @param string|null $message
     */
    public static function assertIsNullableString($actual, ?string $message = null): void
    {
        static::assertIsNullableType(
            is_null($actual) || is_string($actual),
            'string',
            $actual,
            $message
        );
    }

    /**
     * @param int|mixed|null $actual
     * @param string|null $message
     */
    public static function assertIsNullableInt($actual, ?string $message = null): void
    {
        static::assertIsNullableType(
            is_null($actual) || is_int($actual),
            'int',
            $actual,
            $message
        );
    }

    /**
     * @param float|mixed|null $actual
     * @param string|null $message
     */
    public static function assertIsNullableFloat($actual, ?string $message = null): void
    {
        static::assertIsNullableType(
            is_null($actual) || (is_numeric($actual) && (is_int($actual) || is_float($actual))),
            'float',
            $actual,
            $message
        );
    }

    /**
     * @param array|mixed|null $actual
     * @param string|null $message
     */
    public static function assertIsNullableArray($actual, ?string $message = null): void
    {
        static::assertIsNullableType(
            is_null($actual) || is_array($actual),
            'array',
            $actual,
            $message
        );
    }

    /**
     * @param bool $condition
     * @param string $type
     * @param mixed|null $actual
     * @param string|null $message
     */
    private static function assertIsNullableType(bool $condition, string $type, $actual, ?string $message = null): void
    {
        PHPUnit::assertTrue(
            $condition,
            $message ?? sprintf(
                'Failed to assert that "%s" is type of null|%s.'.PHP_EOL.'%s',
                gettype($actual),
                $type,
                var_export($actual, true)
            )
        );
    }
}
