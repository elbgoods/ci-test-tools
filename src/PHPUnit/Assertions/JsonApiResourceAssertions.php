<?php

namespace Elbgoods\CiTestTools\PHPUnit\Assertions;

use Illuminate\Foundation\Testing\Assert as PHPUnit;

trait JsonApiResourceAssertions
{
    public static function assertIsJsonApiResource(array $actual, ?string $type = null, ?int $id = null): void
    {
        PHPUnit::assertArrayHasKey('id', $actual);
        PHPUnit::assertIsInt($actual['id']);
        PHPUnit::assertTrue(0 < $actual['id']);
        if ($id !== null) {
            PHPUnit::assertEquals($id, $actual['id']);
        }

        PHPUnit::assertArrayHasKey('type', $actual);
        PHPUnit::assertIsString($actual['type']);
        if ($type !== null) {
            PHPUnit::assertEquals($type, $actual['type']);
        }
    }
}
