<?php

namespace App\Http\Controllers;

use App\Services\StatisticService;
use Illuminate\Http\JsonResponse;

class StatisticController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return JsonResponse|null
     */
    public function __invoke(): ?JsonResponse
    {
        return StatisticService::get();
    }
}
