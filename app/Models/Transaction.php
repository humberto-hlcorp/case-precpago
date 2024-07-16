<?php

namespace App\Models;

use App\Models\Cache\CacheStorage;
use Exception;

class Transaction
{
    /**
     * Instantiate a new instance.
     *
     * return void
     * @throws Exception
     */
    public function __construct()
    {
    }

    /**
     * Create.
     *
     * @param string $key
     * @param array $models
     * @return bool
     * @throws Exception
     */
    public static function create(string $key, array $models = []): bool
    {
        return CacheStorage::set($key, $models);
    }

    /**
     * Delete.
     *
     * @return bool
     */
    public static function delete(): bool
    {
        CacheStorage::clear();
        return true;
    }
}
