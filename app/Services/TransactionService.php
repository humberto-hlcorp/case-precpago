<?php

namespace App\Services;

use App\Repositories\Cache\TransactionRepositoryStrategy;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class TransactionService
{
    /**
     * Instantiate a new service instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param array $request
     * @return JsonResponse
     * @throws Exception
     */
    public function store(array $request): JsonResponse
    {
        $now = Carbon::now();

        if ($this->isValidTimestampInFuture($now, $request['timestamp']) || !$this->isValidJson($request))
            return response()->json([], Response::HTTP_UNPROCESSABLE_ENTITY);

        if ($this->isValidTimestampOld($now, $request['timestamp']))
            return response()->json([], Response::HTTP_NO_CONTENT);

        $dateTimeIso8601 = new DateTime($request['timestamp'], new \DateTimeZone('UTC'));
        $request['timestamp'] = $dateTimeIso8601->format('Y-m-d\\TH:i:s.vp');

        if (TransactionRepositoryStrategy::store(config('precpago.prefix_transaction') . strtotime($now), $request))
            return response()->json([], Response::HTTP_CREATED);

        return response()->json([], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return JsonResponse|null
     */
    public function destroy(): ?JsonResponse
    {
        TransactionRepositoryStrategy::destroy();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }

    /**
     * Is it valid timestamp in the future?
     *
     * @param $now
     * @param string $timestamp
     * @return bool
     */
    private function isValidTimestampInFuture($now, string $timestamp): bool
    {
        if (strtotime($timestamp) > strtotime($now)) return true;

        return false;
    }

    /**
     * Is it valid timestamp in the past?
     *
     * @param $now
     * @param string $timestamp
     * @return bool
     */
    private function isValidTimestampOld($now, string $timestamp): bool
    {
        $diffSeconds = $now->diffInSeconds($timestamp);

        if ($diffSeconds > (int) config('precpago.timeout')) return true;

        return false;
    }

    /**
     * Is it valid JSON?
     *
     * @param array $request
     * @return bool
     */
    private function isValidJson(array $request): bool
    {
        if (json_validate(json_encode($request))) return true;

        return false;
    }

}
