<?php

namespace Tests\Unit\Services;

use App\Services\TransactionService;
use PHPUnit\Framework\TestCase;

class TransactionServiceTest extends TestCase
{
    protected TransactionService $class;

    protected function setUp(): void
    {
        $this->class = new TransactionService();

        parent::setUp();
    }

    /**
     * Class has method store.
     */
    public function test_has_method_store(): void
    {
        $methods = get_class_methods($this->class);

        $expected = 'store';

        $this->assertContains($expected, $methods);
    }

    /**
     * Class has method destroy.
     */
    public function test_has_method_destroy(): void
    {
        $methods = get_class_methods($this->class);

        $expected = 'destroy';

        $this->assertContains($expected, $methods);
    }
}
