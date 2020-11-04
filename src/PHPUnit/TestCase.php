<?php

namespace Elbgoods\CiTestTools\PHPUnit;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
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
