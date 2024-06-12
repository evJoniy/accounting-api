<?php

namespace App\Repositories;

use App\Filters\TransactionFilter;
use App\Models\Transaction;
use App\Repositories\Interfaces\TransactionRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function __construct(
        protected TransactionFilter $filter
    ) {
    }

    /** @inheritdoc */
    public function getAllTransactions(array $filters): Collection
    {
        return $this->filter->getAll(Transaction::query())->get();
    }

    /** @inheritdoc */
    public function getTransactionById(int $transactionId): mixed
    {
        return Transaction::findOrFail($transactionId);
    }

    /** @inheritdoc */
    public function createNewTransaction(array $data): mixed
    {
        return Transaction::create($data);
    }

    /** @inheritdoc */
    public function deleteTransactionById(int $transactionId): void
    {
        $transaction = Transaction::findOrFail($transactionId);
        $transaction->delete();
    }
}
