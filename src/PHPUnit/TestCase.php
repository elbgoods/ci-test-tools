<?php

namespace Elbgoods\CiTestTools\PHPUnit;

use Elbgoods\CiTestTools\PHPUnit\Assertions\CommonAssertions;
use Elbgoods\CiTestTools\PHPUnit\Assertions\EnumAssertions;
use Elbgoods\CiTestTools\PHPUnit\Assertions\JsonApiResourceAssertions;
use Elbgoods\CiTestTools\PHPUnit\Assertions\ModelAssertions;
use Elbgoods\CiTestTools\PHPUnit\Assertions\NullableTypeAssertions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use JMac\Testing\Traits\AdditionalAssertions;

abstract class TestCase extends BaseTestCase
{
    use AdditionalAssertions,
        EnumAssertions,
        ModelAssertions,
        NullableTypeAssertions,
        JsonApiResourceAssertions,
        CommonAssertions;

    protected function setUp(): void
    {
        parent::setUp();

        $this->runTraitMethods('setUp');
    }

    protected function tearDown(): void
    {
        $this->runTraitMethods('tearDown');

        parent::tearDown();
    }

    protected function runTraitMethods(string $prefix): void
    {
        $booted = [];

        foreach (class_uses_recursive($this) as $trait) {
            $method = $prefix.class_basename($trait).'Trait';

            if (method_exists($this, $method) && ! in_array($method, $booted)) {
                call_user_func([$this, $method]);

                $booted[] = $method;
            }
        }
    }
}
