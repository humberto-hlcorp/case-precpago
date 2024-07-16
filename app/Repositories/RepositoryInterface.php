<?php

namespace App\Repositories;

use Exception;

interface RepositoryInterface
{
    /**
     * Store a newly created resource in storage.
     *
     * @param string $key
     * @param array $transaction
     * @return bool
     * @throws Exception
     */
    public static function store(string $key, array $transaction): bool;

    /**
     * Remove the specified resource from storage.
     *
     * @return bool
     */
    public static function destroy(): bool;
}
