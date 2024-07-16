<?php

namespace Tests\Feature\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Response;
use Tests\TestCase;
use DateTime;

class TransactionControllerTest extends TestCase
{
    protected string $url;

    protected function setUp(): void
    {
        $this->url = 'api/transactions';

        parent::setUp();
    }

    /**
     * Post transaction successfully.
     */
    public function test_post_transaction_successfully(): void
    {
        $now = Carbon::now();
        $dateTimeIso8601 = new DateTime($now, new \DateTimeZone('UTC'));

        $body = [
            "amount" => "7.33",
            "timestamp"=> $dateTimeIso8601->format('Y-m-d\\TH:i:s.vp'),
        ];

        $response = $this->post($this->url, $body);

        $response->assertStatus(Response::HTTP_CREATED);
    }

    /**
     * Post transaction timestamp future.
     */
    public function test_post_transaction_timestamp_future(): void
    {
        $now = Carbon::now()->addMinutes(5);
        $dateTimeIso8601 = new DateTime($now, new \DateTimeZone('UTC'));

        $body = [
            "amount" => "10.1234",
            "timestamp"=> $dateTimeIso8601->format('Y-m-d\\TH:i:s.vp'),
        ];

        $response = $this->post($this->url, $body);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Post transaction timestamp old.
     */
    public function test_post_transaction_timestamp_old(): void
    {
        $now = Carbon::now()->addMinutes(-2);
        $dateTimeIso8601 = new DateTime($now, new \DateTimeZone('UTC'));

        $body = [
            "amount" => "10.1234",
            "timestamp"=> $dateTimeIso8601->format('Y-m-d\\TH:i:s.vp'),
        ];

        $response = $this->post($this->url, $body);

        $response->assertStatus(Response::HTTP_NO_CONTENT);
    }

    /**
     * Post transaction invalid json.
     */
    public function test_post_transaction_invalid_json(): void
    {
        $body = [
            "amount" => "10.1234",
        ];

        $response = $this->post($this->url, $body);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Delete all transactions.
     */
    public function test_delete_transaction(): void
    {
        $response = $this->delete($this->url);

        $response->assertStatus(Response::HTTP_NO_CONTENT);
    }
}
