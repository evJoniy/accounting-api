<?php

namespace App\Repositories;

use App\Filters\TransactionFilter;
use App\Models\Transaction;
use App\Repositories\Interfaces\TransactionRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
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

    /** @inheritdoc */
    public function getTransactionsSummaryByPeriodAndType(
        int $userId,
        string $startDate,
        string $endDate,
        string $type
    ): float {
        return $this->getTransactionsQueryByPeriod($userId, $startDate, $endDate)
            ->where('amount', $type === 'income' ? '>' : '<', 0)
            ->sum('amount');
    }

    /** @inheritdoc */
    public function getTransactionsSummaryByPeriod(int $userId, string $startDate, string $endDate): float
    {
        return $this->getTransactionsQueryByPeriod($userId, $startDate, $endDate)
            ->sum('amount');
    }

    /**
     * @param int $userId
     * @param string $startDate
     * @param string $endDate
     * @return Builder
     */
    protected function getTransactionsQueryByPeriod(int $userId, string $startDate, string $endDate): Builder
    {
        return Transaction::where('author_id', $userId)
            ->whereBetween('created_at', [$startDate, $endDate]);
    }
}
