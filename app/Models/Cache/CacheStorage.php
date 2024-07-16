<?php

namespace App\Models\Cache;

use Illuminate\Contracts\Cache\LockTimeoutException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Exception;

class CacheStorage
{
    /**
     * Set cache.
     *
     * @param string $key
     * @param array $data
     * @return bool
     * @throws Exception
     */
    public static function set(string $key, array $data): bool
    {
        $tag = config('precpago.prefix_tag');

        $lock = Cache::lock($key, 3);

        try {
            $lock->block(3);

            Redis::hSet($tag, $key, json_encode($data));

            return true;
        } catch (LockTimeoutException $e) {
            throw new \Exception($e->getMessage());
        } finally {
            $lock->release();
        }
    }

    /**
     * Get cache.
     *
     * @return Collection
     */
    public static function get(): Collection
    {
        $transactions = Redis::hGetAll(config('precpago.prefix_tag'));

        $collection = collect();

        foreach ($transactions as $transaction)
            $collection->push(json_decode($transaction));

        return $collection;
    }

    /**
     * Clear cache.
     *
     * @return void
     */
    public static function clear(): void
    {
        Redis::del(config('precpago.prefix_tag'));
    }

    /**
     * Is Empty.
     *
     * @return bool
     */
    public static function isEmpty(): bool
    {
        if (count(self::get()) == 0) return true;

        return false;
    }
}
