<?php

namespace Elbgoods\CiTestTools\PHPUnit\Assertions;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\Assert as PHPUnit;

trait ModelAssertions
{
    /**
     * @param Model $expected
     * @param array|Model|mixed $actual
     * @param string|null $message
     */
    public static function assertEqualsModel(Model $expected, $actual, ?string $message = null): void
    {
        if (
            $expected->exists
            && $actual instanceof Model
            && $actual->exists
        ) {
            PHPUnit::assertTrue($expected->is($actual));
        }

        foreach (array_diff($expected->getFillable(), $expected->getHidden()) as $attribute) {
            $expectedValue = $expected->getAttribute($attribute);

            if ($expectedValue instanceof DateTimeInterface) {
                PHPUnit::assertTrue(
                    Carbon::instance($expectedValue)->isSameAs(Carbon::ISO8601, data_get($actual, $attribute)),
                    $message ?? "Failed to assert that attribute \"{$attribute}\" equals expected value."
                );
            } else {
                PHPUnit::assertEquals(
                    $expectedValue,
                    data_get($actual, $attribute),
                    $message ?? "Failed to assert that attribute \"{$attribute}\" equals expected value."
                );
            }
        }
    }

    public static function assertModelEquals(Model $expected, Model $actual, ?string $message = null): void
    {
        PHPUnit::assertInstanceOf(get_class($expected), $actual);

        static::assertEqualsModel($expected, $actual, $message);
    }

    /**
     * @param array|mixed $actual
     */
    public static function assertIsTranslatableString($actual): void
    {
        PHPUnit::assertIsArray($actual);
        PHPUnit::assertArrayHasKey('en', $actual);
        PHPUnit::assertIsString($actual['en']);
        foreach ($actual as $translation) {
            NullableTypeAssertions::assertIsNullableString($translation);
        }
    }
}
