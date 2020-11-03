<?php

namespace Elbgoods\CiTestTools\PHPUnit\Assertions;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Constraints\HasInDatabase;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Assert as PHPUnit;

trait ModelAssertions
{
    /**
     * Assert the given record exists.
     *
     * @param  \Illuminate\Database\Eloquent\Model|string  $table
     * @param  array  $data
     * @param  string|null  $connection
     * @return void
     */
    public static function assertExists($table, array $data = [], ?string $connection = null): void
    {
        if ($table instanceof Model) {
            $model = $table;

            $table = $model->getTable();
            $connection = $model->getConnectionName();
            $data = [
                $model->getKeyName() => $model->getKey(),
            ];
        }

        PHPUnit::assertThat(
            $table, new HasInDatabase(DB::connection($connection), $data)
        );
    }

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
