<?php

namespace Elbgoods\CiTestTools\PHPUnit\Assertions;

use Illuminate\Foundation\Testing\Assert as PHPUnit;
use Illuminate\Support\Arr;

trait CommonAssertions
{
    public static function assertEqualsArray(array $expected, $actual): void
    {
        PHPUnit::assertIsArray($actual);

        $expected = Arr::sortRecursive($expected);
        $actual = Arr::sortRecursive($actual);

        PHPUnit::assertEquals($expected, $actual);
    }
}
