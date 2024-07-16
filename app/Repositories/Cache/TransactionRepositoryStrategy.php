<?php

namespace App\Repositories\Cache;

use App\Models\Transaction;
use App\Repositories\RepositoryInterface;
use Exception;

class TransactionRepositoryStrategy implements RepositoryInterface
{
    /**
     * Store a newly created resource in storage.
     *
     * @param string $key
     * @param array $transaction
     * @return bool
     * @throws Exception
     */
    public static function store(string $key, array $transaction): bool
    {
        return Transaction::create($key, $transaction);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return bool
     */
    public static function destroy(): bool
    {
        return Transaction::delete();
    }
}
