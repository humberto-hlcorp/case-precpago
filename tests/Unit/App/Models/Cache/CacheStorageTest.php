<?php

namespace Tests\Unit\App\Models\Cache;

use App\Models\Cache\CacheStorage;
use PHPUnit\Framework\TestCase;

class CacheStorageTest extends TestCase
{
    protected CacheStorage $class;

    protected function setUp(): void
    {
        $this->class = new CacheStorage();

        parent::setUp();
    }
    /**
     * Class has method set.
     */
    public function test_has_method_set(): void
    {
        $methods = get_class_methods($this->class);

        $expected = 'set';

        $this->assertContains($expected, $methods);
    }

    /**
     * Class has method get.
     */
    public function test_has_method_get(): void
    {
        $methods = get_class_methods($this->class);

        $expected = 'get';

        $this->assertContains($expected, $methods);
    }

    /**
     * Class has method clear.
     */
    public function test_has_method_clear(): void
    {
        $methods = get_class_methods($this->class);

        $expected = 'clear';

        $this->assertContains($expected, $methods);
    }

    /**
     * Class has method get.
     */
    public function test_has_method_is_empty(): void
    {
        $methods = get_class_methods($this->class);

        $expected = 'isEmpty';

        $this->assertContains($expected, $methods);
    }

}
