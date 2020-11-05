<?php

namespace Elbgoods\CiTestTools\PHPUnit\Assertions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Testing\Constraints\HasInDatabase;
use PHPUnit\Framework\Assert as PHPUnit;

trait ModelAssertions
{
    /**
     * @param Model|string  $table
     * @param array $data
     * @param string|null $connection
     *
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
            $table,
            new HasInDatabase(DB::connection($connection), $data)
        );
    }

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
