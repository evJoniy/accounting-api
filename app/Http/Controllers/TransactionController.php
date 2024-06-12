<?php

namespace App\Http\Controllers;

use App\Http\Requests\Transaction\DeleteRequest;
use App\Http\Requests\Transaction\ShowRequest;
use App\Http\Requests\Transaction\StoreRequest;
use App\Services\TransactionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct(
        protected TransactionService $transactionService
    ) {
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $transactions = $this->transactionService->getAllTransactions($request->only(['type', 'amount', 'date']));

        return new JsonResponse($transactions);
    }

    /**
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $transaction = $this->transactionService->createNewTransaction($request->all());

        return new JsonResponse($transaction, 201);
    }

    /**
     * @param ShowRequest $request
     * @return JsonResponse
     */
    public function show(ShowRequest $request): JsonResponse
    {
        $transaction = $this->transactionService->getTransactionById($request->get('id'));

        return new JsonResponse($transaction);
    }

    /**
     * @param DeleteRequest $request
     * @return JsonResponse
     */
    public function destroy(DeleteRequest $request): JsonResponse
    {
        $this->transactionService->deleteTransactionById($request->get('id'));

        return new JsonResponse();
    }
}
