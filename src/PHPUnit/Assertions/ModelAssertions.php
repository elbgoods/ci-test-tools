<?php

namespace Elbgoods\CiTestTools\PHPUnit\Assertions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use PHPUnit\Framework\Assert as PHPUnit;

trait ModelAssertions
{
    /**
     * @param Model $expected
     * @param array|Model|mixed $actual
     * @param bool $considerHiddenAttributes
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

        foreach (Arr::except($expected->getFillable(), $expected->getHidden()) as $attribute) {
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
        foreach ($actual as $translation) {
            NullableTypeAssertions::assertIsNullableString($translation);
        }
    }
}
