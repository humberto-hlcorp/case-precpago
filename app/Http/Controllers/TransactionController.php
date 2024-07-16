<?php

namespace App\Http\Controllers;

use App\Requests\TransactionRequest;
use App\Services\TransactionService;
use \Illuminate\Http\JsonResponse;
use Exception;

class TransactionController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct
    (
        protected TransactionService $transactionService
    )
    {
        $this->transactionService = new TransactionService();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TransactionRequest $request
     * @return JsonResponse|null
     * @throws Exception
     */
    public function store(TransactionRequest $request): ?JsonResponse
    {
        return $this->transactionService->store($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return JsonResponse|null
     */
    public function destroy(): ?JsonResponse
    {
        return $this->transactionService->destroy();
    }
}
