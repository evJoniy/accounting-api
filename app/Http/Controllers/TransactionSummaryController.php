<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionSummary\SummaryRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Services\TransactionService;

class TransactionSummaryController extends Controller
{
    public function __construct(
        protected TransactionService $transactionService
    ) {
    }

    public function index(SummaryRequest $request): JsonResponse
    {
        $result = $this->transactionService->getSummary($request->all(), Auth::id());

        return new JsonResponse($result);
    }
}
