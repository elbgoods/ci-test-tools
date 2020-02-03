<?php

namespace Elbgoods\CiTestTools\PHPUnit\Assertions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\Assert as PHPUnit;

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

        foreach ($expected->getFillable() as $attribute) {
            PHPUnit::assertEquals(
                $expected->getAttribute($attribute),
                data_get($actual, $attribute),
                $message ?? "Failed to assert that attribute \"{$attribute}\" equals expected value."
            );
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
        foreach ($actual as $locale => $translation) {
            NullableTypeAssertions::assertIsNullableString($translation);
        }
    }
}
