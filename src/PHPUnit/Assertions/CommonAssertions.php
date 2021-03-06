<?php

namespace Elbgoods\CiTestTools\PHPUnit\Assertions;

use Illuminate\Support\Arr;
use PHPUnit\Framework\Assert as PHPUnit;

trait CommonAssertions
{
    /**
     * @param array $expected
     * @param array|mixed $actual
     */
    public static function assertEqualsArray(array $expected, $actual): void
    {
        PHPUnit::assertIsArray($actual);

        $expected = Arr::sortRecursive($expected);
        $actual = Arr::sortRecursive($actual);

        PHPUnit::assertEquals($expected, $actual);
    }
}
