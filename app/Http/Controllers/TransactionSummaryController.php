<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionSummary\SummaryRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Services\TransactionService;

/**
 * @OA\Tag(
 *    name="Transactions",
 *    description="API Endpoints for Transactions Summary"
 * )
 */
class TransactionSummaryController extends Controller
{
    public function __construct(
        protected TransactionService $transactionService
    ) {
    }

    /**
     * @OA\Get(
     *     path="/api/transaction-summary",
     *     summary="Get transaction summary",
     *     tags={"TransactionSummary"},
     *     @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/StoreRequest")),
     *     @OA\Response(response=200, description="Transaction summary", @OA\JsonContent(type="object"))
     * )
     *
     * @param SummaryRequest $request
     * @return JsonResponse
     */
    public function index(SummaryRequest $request): JsonResponse
    {
        $result = $this->transactionService->getSummary($request->all(), Auth::id());

        return new JsonResponse($result);
    }
}
