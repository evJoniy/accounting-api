<?php

namespace App\Http\Controllers;

use App\Http\Requests\Transaction\DeleteRequest;
use App\Http\Requests\Transaction\ShowRequest;
use App\Http\Requests\Transaction\StoreRequest;
use App\Services\TransactionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *    name="Transactions",
 *    description="API Endpoints for Transactions"
 * )
 */
class TransactionController extends Controller
{
    public function __construct(
        protected TransactionService $transactionService
    ) {
    }

    /**
     * @OA\Get(
     *     path="/api/transactions",
     *     summary="Get all transactions",
     *     tags={"Transactions"},
     *     @OA\Parameter(name="type", in="query", description="Type of the transaction", required=false, @OA\Schema(type="string")),
     *     @OA\Parameter(name="amount", in="query", description="Amount of the transaction", required=false, @OA\Schema(type="number")),
     *     @OA\Parameter(name="date", in="query", description="Date of the transaction", required=false, @OA\Schema(type="string", format="date")),
     *     @OA\Response(response=200, description="A list of transactions", @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Transaction")))
     * )
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $transactions = $this->transactionService->getAllTransactions($request->only(['type', 'amount', 'date']));

        return new JsonResponse($transactions);
    }

    /**
     * @OA\Post(
     *     path="/api/transactions",
     *     summary="Create new transaction",
     *     tags={"Transactions"},
     *     @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/StoreRequest")),
     *     @OA\Response(response=200, description="Transaction created", @OA\JsonContent(ref="#/components/schemas/Transaction"))
     * )
     *
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $transaction = $this->transactionService->createNewTransaction($request->all());

        return new JsonResponse($transaction, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/transactions/{id}",
     *     summary="Get a transaction by ID",
     *     tags={"Transactions"},
     *     @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/ShowRequest")),
     *     @OA\Response(response=200, description="Transaction details", @OA\JsonContent(ref="#/components/schemas/Transaction"))
     * )
     *
     * @param ShowRequest $request
     * @return JsonResponse
     */
    public function show(ShowRequest $request): JsonResponse
    {
        $transaction = $this->transactionService->getTransactionById($request->get('id'));

        return new JsonResponse($transaction);
    }

    /**
     * @OA\Delete(
     *     path="/api/transactions/{id}",
     *     summary="Delete a transaction by ID",
     *     tags={"Transactions"},
     *     @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/DeleteRequest")),
     *     @OA\Response(response=200, description="Transaction deleted")
     * )
     *
     * @param DeleteRequest $request
     * @return JsonResponse
     */
    public function destroy(DeleteRequest $request): JsonResponse
    {
        $this->transactionService->deleteTransactionById($request->get('id'));

        return new JsonResponse();
    }
}
