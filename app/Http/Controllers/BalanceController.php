<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\BalanceService;

class BalanceController extends Controller
{
    public function __construct(
        protected BalanceService $balanceService
    ) {
    }

    /**
     * @param Request $request
     * @param $currency
     * @return JsonResponse
     */
    public function getBalance(Request $request, $currency): JsonResponse
    {
        $balance = $this->balanceService->getUserBalanceInCurrency(Auth::id(), $currency);

        return new JsonResponse(['balance' => $balance]);
    }
}
