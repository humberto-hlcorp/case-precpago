<?php

namespace Tests\Feature\Services;

use App\Services\TransactionService;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Tests\TestCase;
use DateTime;
use Exception;

class TransactionServiceTest extends TestCase
{
    protected TransactionService $class;

    protected function setUp(): void
    {
        $this->class = new TransactionService();

        parent::setUp();
    }

    /**
     * Store a newly created resource in storage successfully.
     * @throws Exception
     */
    public function test_store_transaction_successfully(): void
    {
        $now = Carbon::now();
        $dateTimeIso8601 = new DateTime($now, new \DateTimeZone('UTC'));

        $formRequest = [
            "amount" => "7.33",
            "timestamp"=> $dateTimeIso8601->format('Y-m-d\\TH:i:s.vp'),
        ];

        $response = $this->class->store($formRequest);

        $this->assertTrue($response->getStatusCode() == Response::HTTP_CREATED ? true : false);
    }

    /**
     * Store a newly created resource in storage with timestamp future.
     */
    public function test_post_transaction_timestamp_future(): void
    {
        $now = Carbon::now()->addMinutes(5);
        $dateTimeIso8601 = new DateTime($now, new \DateTimeZone('UTC'));

        $formRequest = [
            "amount" => "10.1234",
            "timestamp"=> $dateTimeIso8601->format('Y-m-d\\TH:i:s.vp'),
        ];

        $response = $this->class->store($formRequest);

        $this->assertTrue($response->getStatusCode() == Response::HTTP_UNPROCESSABLE_ENTITY ? true : false);
    }

    /**
     * Store a newly created resource in storage with timestamp old.
     */
    public function test_post_transaction_timestamp_old(): void
    {
        $now = Carbon::now()->addMinutes(-2);
        $dateTimeIso8601 = new DateTime($now, new \DateTimeZone('UTC'));

        $formRequest = [
            "amount" => "10.1234",
            "timestamp"=> $dateTimeIso8601->format('Y-m-d\\TH:i:s.vp'),
        ];

        $response = $this->class->store($formRequest);

        $this->assertTrue($response->getStatusCode() == Response::HTTP_NO_CONTENT ? true : false);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function test_destroy_transaction(): void
    {
        $response = $this->class->destroy();

        $this->assertTrue($response->getStatusCode() == Response::HTTP_NO_CONTENT ? true : false);
    }
}
