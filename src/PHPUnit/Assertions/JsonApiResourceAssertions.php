<?php

namespace Elbgoods\CiTestTools\PHPUnit\Assertions;

use Closure;
use Illuminate\Foundation\Testing\Assert as PHPUnit;
use InvalidArgumentException;
use OutOfBoundsException;

trait JsonApiResourceAssertions
{
    /** @var array */
    protected static $jsonApiResourceAssertions = [];

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

    public static function assertIsJsonApiResourceOfType(string $type, $actual, ...$params): void
    {
        static::assertIsJsonApiResource($actual);

        if (! array_key_exists($type, static::$jsonApiResourceAssertions)) {
            throw new OutOfBoundsException(sprintf('There is no assertion registered for type "%s".', $type));
        }

        call_user_func(static::$jsonApiResourceAssertions[$type], $actual, ...$params);
    }

    public static function registerJsonApiResourceAssertion(string $type, Closure $assertion): void
    {
        if (array_key_exists($type, static::$jsonApiResourceAssertions)) {
            throw new InvalidArgumentException(sprintf('There is already an assertion registered for type "%s".', $type));
        }

        static::$jsonApiResourceAssertions[$type] = $assertion;
    }
}
