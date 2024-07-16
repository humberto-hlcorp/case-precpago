<?php

namespace Tests\Unit\App\Models;

use App\Models\Transaction;
use PHPUnit\Framework\TestCase;

class TransactionTest extends TestCase
{
    protected Transaction $class;

    protected function setUp(): void
    {
        $this->class = new Transaction();

        parent::setUp();
    }

    /**
     * Class has method create.
     */
    public function test_has_method_create(): void
{
    $methods = get_class_methods($this->class);

    $expected = 'create';

    $this->assertContains($expected, $methods);
}

    /**
     * Class has method delete.
     */
    public function test_has_method_delete(): void
{
    $methods = get_class_methods($this->class);

    $expected = 'delete';

    $this->assertContains($expected, $methods);
}
}
