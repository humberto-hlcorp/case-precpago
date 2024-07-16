<?php

namespace Tests\Unit\Repositories\Cache;

use App\Repositories\Cache\TransactionRepositoryStrategy;
use PHPUnit\Framework\TestCase;

class TransactionRepositoryStrategyTest extends TestCase
{
    protected TransactionRepositoryStrategy $class;

    protected function setUp(): void
    {
        $this->class = new TransactionRepositoryStrategy();

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
