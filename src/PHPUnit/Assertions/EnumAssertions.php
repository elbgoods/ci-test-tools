<?php

namespace Elbgoods\CiTestTools\PHPUnit\Assertions;

use Exception;
use PHPUnit\Framework\Assert as PHPUnit;
use Spatie\Enum\Enum;

trait EnumAssertions
{
    /**
     * @param Enum|mixed $actual
     * @param string|null $message
     */
    public static function assertIsEnum($actual, ?string $message = null): void
    {
        PHPUnit::assertInstanceOf(
            Enum::class,
            $actual,
            $message ?? sprintf('Failed asserting that the value is instance of %s.', Enum::class)
        );
    }

    /**
     * @param Enum $expected
     * @param Enum|string|int|mixed $actual
     * @param string|null $message
     */
    public static function assertEqualsEnum(Enum $expected, $actual, ?string $message = null): void
    {
        PHPUnit::assertTrue(
            $expected->isEqual($actual),
            $message ?? sprintf('Failed asserting that the value is equal to enum %s with value %s.', get_class($expected), $expected->getValue())
        );
    }

    /**
     * @param string $expected
     * @param string|int|mixed $actual
     * @param string|null $message
     */
    public static function assertIsEnumValue(string $expected, $actual, ?string $message = null): void
    {
        try {
            $enum = forward_static_call([$expected, 'make'], $actual);

            PHPUnit::assertInstanceOf($expected, $enum);
        } catch (Exception $ex) {
            PHPUnit::assertTrue(false, $message ?? $ex->getMessage());
        }
    }

    /**
     * @param string $expected
     * @param string|int|mixed|null $actual
     * @param string|null $message
     */
    public static function assertIsNullableEnumValue(string $expected, $actual, ?string $message = null): void
    {
        PHPUnit::assertTrue(
            is_null($actual) || is_int($actual) || is_string($actual),
            $message ?? 'Failed asserting that the value is type of null|int|string.'
        );

        if ($actual !== null) {
            static::assertIsEnumValue($expected, $actual, $message);
        }
    }
}
