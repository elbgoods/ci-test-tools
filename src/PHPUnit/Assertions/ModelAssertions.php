<?php

namespace Elbgoods\CiTestTools\PHPUnit\Assertions;

use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\Assert as PHPUnit;

trait ModelAssertions
{
    /**
     * @param Model $expected
     * @param array|Model|mixed $actual
     * @param bool $considerHiddenAttributes
     * @param string|null $message
     */
    public static function assertEqualsModel(
        Model $expected,
        $actual,
        bool $considerHiddenAttributes = false,
        ?string $message = null
    ): void {
        if (
            $expected->exists
            && $actual instanceof Model
            && $actual->exists
        ) {
            PHPUnit::assertTrue($expected->is($actual));
        }

        $hiddenAttributes = $expected->getHidden();

        foreach ($expected->getFillable() as $attribute) {
            if ($considerHiddenAttributes || ! in_array($hiddenAttributes, $attribute)) {
                PHPUnit::assertEquals(
                    $expected->getAttribute($attribute),
                    data_get($actual, $attribute),
                    $message ?? "Failed to assert that attribute \"{$attribute}\" equals expected value."
                );
            }
        }
    }

    public static function assertModelEquals(Model $expected, Model $actual, ?string $message = null): void
    {
        PHPUnit::assertInstanceOf(get_class($expected), $actual);

        static::assertEqualsModel($expected, $actual, true, $message);
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
