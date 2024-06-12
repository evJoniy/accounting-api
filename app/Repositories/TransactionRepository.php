<?php

namespace App\Repositories;

use App\Models\Transaction;
use App\Repositories\Interfaces\TransactionRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class TransactionRepository implements TransactionRepositoryInterface
{
    /** @inheritdoc */
    public function getAllTransactions(array $filters): Collection
    {
        return Transaction::query()
            ->when($filters['type'] ?? null, fn($query, $type) => match ($type) {
                'income' => $query->where('amount', '>', 0),
                'expense' => $query->where('amount', '<', 0),
                default => $query,
            })
            ->when($filters['amount'] ?? null, fn($query, $amount) => $query->where('amount', $amount))
            ->when($filters['date'] ?? null, fn($query, $date) => $query->whereDate('created_at', $date))
            ->get();
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
