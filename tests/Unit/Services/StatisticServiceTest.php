<?php

namespace Tests\Unit\Services;

use App\Services\StatisticService;
use PHPUnit\Framework\TestCase;

class StatisticServiceTest extends TestCase
{
    /**
     * Class has method get.
     */
    public function test_has_method_get(): void
    {
        $methods = get_class_methods(new StatisticService());

        $expected = 'get';

        $this->assertContains($expected, $methods);
    }
}
