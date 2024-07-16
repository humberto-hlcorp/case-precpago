<?php

namespace App\Services;

use App\Models\Cache\CacheStorage;
use Carbon\Carbon;
use \Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class StatisticService
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
     * Retrieve statistics data.
     *
     * @return JsonResponse|null
     */
    public static function get(): ?JsonResponse
    {
        $data = self::process();

        return response()->json($data, Response::HTTP_OK);
    }

    /**
     * Process statistics
     *
     * @return Collection
     */
    private static function process(): Collection
    {
        $data = CacheStorage::get();

        $now = Carbon::now();

        $filterTimestampLastMinute = self::filterTimestampLastMinute($now, $data);

        if (CacheStorage::isEmpty() || count($filterTimestampLastMinute) == 0)
            return self::createEmptyData();

        return $filterTimestampLastMinute->pipe(function ($item) {
            return collect([
                'sum' => (string) round($item->sum('amount'), 2, PHP_ROUND_HALF_UP),
                'avg' => (string) round($item->avg('amount'), 2, PHP_ROUND_HALF_UP),
                'max' => (string) round($item->max('amount'), 2, PHP_ROUND_HALF_UP),
                'min' => (string) round($item->min('amount'), 2, PHP_ROUND_HALF_UP),
                'count' => $item->count()
            ]);
        });
    }

    /**
     * Is it valid timestamp in the future?
     *
     * @param $now
     * @param Collection $data
     * @return Collection
     */
    private static function filterTimestampLastMinute($now, Collection $data): Collection
    {
        return $data->filter(function($item) use ($now) {
            return strtotime($item->timestamp) >= strtotime($now) - (int) config('precpago.timeout');
        });
    }

    /**
     * Create empty data.
     *
     * @return Collection
     */
    private static function createEmptyData(): Collection
    {
        return collect([
            'sum' => "0.00",
            'avg' => "0.00",
            'max' => "0.00",
            'min' => "0.00",
            'count' => 0
        ]);
    }
}
