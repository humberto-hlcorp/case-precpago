<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Http\Response;
use Tests\TestCase;

class StatisticControllerTest extends TestCase
{
    protected string $url;

    protected function setUp(): void
    {
        $this->url = 'api/statistics';

        parent::setUp();
    }

    /**
     * Get Statistics.
     */
    public function test_get_statistics(): void
    {
        $response = $this->get($this->url);

        $response->assertStatus(Response::HTTP_OK);
    }
}
