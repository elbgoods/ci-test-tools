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
     * @param Model|mixed $actual
     */
    public static function assertModelEquals(Model $expected, $actual): void
    {
        PHPUnit::assertInstanceOf(get_class($expected), $actual);

        PHPUnit::assertTrue($expected->is($actual));
    }

    /**
     * @param array|mixed $actual
     * @param string $locale
     */
    public static function assertIsTranslatableString($actual, string $locale = 'en'): void
    {
        PHPUnit::assertIsArray($actual);
        PHPUnit::assertArrayHasKey($locale, $actual);
        PHPUnit::assertIsString($actual[$locale]);
        foreach ($actual as $translation) {
            NullableTypeAssertions::assertIsNullableString($translation);
        }
    }
}
