<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\BalanceService;

/**
 * @OA\Tag(
 *    name="Transactions",
 *    description="API Endpoints for Balance Converter"
 * )
 */
class BalanceController extends Controller
{
    public function __construct(
        protected BalanceService $balanceService
    ) {
    }

    /**
     * @OA\Get(
     *     path="/api/balance/{currency}",
     *     summary="Get the user's balance in a specific currency",
     *     tags={"Balance"},
     *     @OA\Parameter(name="currency", in="path", description="The currency in which to get the balance", required=true, @OA\Schema(type="string")),
     *     @OA\Response(response=200, description="User balance", @OA\JsonContent(type="object", @OA\Property(property="balance", type="number", example=100.00)))
     * )
     *
     * @param Request $request
     * @param string $currency
     * @return JsonResponse
     */
    public function getBalance(Request $request, string $currency): JsonResponse
    {
        $balance = $this->balanceService->getUserBalanceInCurrency(Auth::id(), $currency);

        return new JsonResponse(['balance' => $balance]);
    }
}
