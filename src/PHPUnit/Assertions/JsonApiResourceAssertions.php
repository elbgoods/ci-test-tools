<?php

namespace Elbgoods\CiTestTools\PHPUnit\Assertions;

use Closure;
use Illuminate\Foundation\Testing\Assert as PHPUnit;
use Illuminate\Support\Str;
use InvalidArgumentException;
use OutOfBoundsException;

trait JsonApiResourceAssertions
{
    /** @var Closure[] */
    protected $jsonApiResourceAssertions = [];

    protected function tearDownJsonApiResourceAssertionsTrait(): void
    {
        $this->jsonApiResourceAssertions = [];
    }

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

    public function assertIsJsonApiResourceOfType(string $type, $actual, ...$params): void
    {
        if (! array_key_exists($type, $this->jsonApiResourceAssertions)) {
            throw new OutOfBoundsException(sprintf('There is no assertion registered for type "%s".', $type));
        }

        static::assertIsJsonApiResource($actual, class_exists($type) ? Str::snake(class_basename($type)) : null);

        call_user_func($this->jsonApiResourceAssertions[$type], $actual, ...$params);
    }

    public function registerJsonApiResourceAssertion(string $type, Closure $assertion): void
    {
        if (array_key_exists($type, $this->jsonApiResourceAssertions)) {
            throw new InvalidArgumentException(sprintf('There is already an assertion registered for type "%s".', $type));
        }

        $this->jsonApiResourceAssertions[$type] = $assertion;
    }
}
