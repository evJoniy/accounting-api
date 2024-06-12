<?php

namespace App\Services;

use App\Events\TransactionAdded;
use App\Repositories\TransactionRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class TransactionService
{
    public function __construct(
        private TransactionRepository $transactionRepository
    ) {
    }

    /**
     * @param Request $request
     * @return Collection|array
     */
    public function getAllTransactions(Request $request): Collection|array
    {
        $filters = $request->only(['type', 'amount', 'date']);

        //additional filters logic

        return $this->transactionRepository->getAllTransactions($filters);
    }

    /**
     * @param int $transactionId
     * @return mixed
     */
    public function getTransactionById(int $transactionId): mixed
    {
        return $this->transactionRepository->getTransactionById($transactionId);
    }

    public function createNewTransaction(array $data)
    {
        $transaction = $this->transactionRepository->createNewTransaction($data);

        Mail::raw(
            'A new transaction has been added.',
            fn($message) => $message->to('example@example.com')->subject('New Transaction')
        );
        Log::info('Transaction added: ' . $transaction->id);

        broadcast(new TransactionAdded($transaction))->toOthers();

        return $transaction;
    }

    /**
     * @param int $transactionId
     * @return void
     */
    public function deleteTransactionById(int $transactionId): void
    {
        $this->transactionRepository->deleteTransactionById($transactionId);
    }
}
