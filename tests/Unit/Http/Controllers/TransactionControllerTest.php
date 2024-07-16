<?php

namespace Tests\Unit\Http\Controllers;

use App\Http\Controllers\TransactionController;
use App\Services\TransactionService;
use PHPUnit\Framework\TestCase;

class TransactionControllerTest extends TestCase
{
    protected TransactionController $class;

    protected function setUp(): void
    {
        $this->class = new TransactionController(new TransactionService());

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
     * Class has method store.
     */
    public function test_has_method_store(): void
    {
        $methods = get_class_methods(new TransactionController(new TransactionService()));

        $expected = 'store';

        $this->assertContains($expected, $methods);
    }

    /**
     * Class has method store.
     */
    public function test_has_method_destroy(): void
    {
        $methods = get_class_methods(new TransactionController(new TransactionService()));

        $expected = 'destroy';

        $this->assertContains($expected, $methods);
    }
}
