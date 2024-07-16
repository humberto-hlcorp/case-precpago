<?php

namespace Tests\Unit\Http\Controllers;

use App\Http\Controllers\StatisticController;
use PHPUnit\Framework\TestCase;

class StatisticControllerTest extends TestCase
{
    protected StatisticController $class;

    protected function setUp(): void
    {
        $this->class = new StatisticController();

        parent::setUp();
    }

    /**
     * Class extends base Controller.
     */
    public function test_class_extends_controller(): void
    {
        $controller = get_parent_class($this->class);

        $expected = 'App\Http\Controllers\Controller';

        $this->assertEquals($expected, $controller);
    }

    /**
     * Class has method invoke (single action).
     */
    public function test_has_method_invoke(): void
    {
        $methods = get_class_methods($this->class);

        $expected = '__invoke';

        $this->assertContains($expected, $methods);
    }
}
