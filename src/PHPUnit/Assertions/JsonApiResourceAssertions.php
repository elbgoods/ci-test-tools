<?php

namespace Elbgoods\CiTestTools\PHPUnit\Assertions;

use Closure;
use InvalidArgumentException;
use OutOfBoundsException;

trait JsonApiResourceAssertions
{
    /** @var Closure[] */
    protected $jsonApiResourceAssertions = [];

    protected function setUpJsonApiResourceAssertionsTrait(): void
    {
        $this->registerJsonApiResourceAssertions();
    }

    abstract protected function registerJsonApiResourceAssertions(): void;

    protected function tearDownJsonApiResourceAssertionsTrait(): void
    {
        $this->jsonApiResourceAssertions = [];
    }

    /**
     * @param string $type
     * @param array|mixed $actual
     * @param mixed ...$params Additional arguments passed to bound callback
     */
    public function assertIsJsonApiResourceOfType(string $type, $actual, ...$params): void
    {
        if (! array_key_exists($type, $this->jsonApiResourceAssertions)) {
            throw new OutOfBoundsException(sprintf('There is no assertion registered for type "%s".', $type));
        }

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
