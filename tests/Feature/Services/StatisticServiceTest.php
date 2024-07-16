<?php

namespace Tests\Feature\Services;

use App\Services\StatisticService;
use Illuminate\Http\Response;
use Tests\TestCase;

class StatisticServiceTest extends TestCase
{
    protected StatisticService $class;

    protected function setUp(): void
    {
        $this->class = new StatisticService();

        parent::setUp();
    }

    /**
     * Get Statistics.
     */
    public function test_get_statistics(): void
    {
        $response = $this->class->get();

        $this->assertTrue($response->getStatusCode() == Response::HTTP_OK ? true : false);
    }
}
