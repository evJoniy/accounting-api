<?php

namespace App\Services;

use App\Events\TransactionAdded;
use App\Repositories\TransactionRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class TransactionService
{
    public function __construct(
        private TransactionRepository $transactionRepository
    ) {
    }

    /**
     * @param array $request
     * @param $userId
     * @return array
     */
    public function getSummary(array $request, $userId): array
    {
        $startDate = $request['startDate'] ?? null;
        $endDate = $request['end_date'] ?? null;

        if (array_key_exists('income', $request)) {
            $income = $this->transactionRepository->getTransactionsSummaryByPeriodAndType($userId, $startDate, $endDate, 'income');
        }

        if (array_key_exists('expense', $request)) {
            $income = $this->transactionRepository->getTransactionsSummaryByPeriodAndType($userId, $startDate, $endDate, 'expense');
        }

        if (array_key_exists('total', $request)) {
            $total = $this->transactionRepository->getTransactionsSummaryByPeriod($userId, $startDate, $endDate);
        }

        return [
            'income' => $income ?? null,
            'expense' => $expense ?? null,
            'total' => $total ?? null,
        ];
    }

    /**
     * @param array $filters
     * @return Collection|array
     */
    public function getAllTransactions(array $filters): Collection|array
    {
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

    /**
     * @param array $data
     * @return mixed
     */
    public function createNewTransaction(array $data): mixed
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
