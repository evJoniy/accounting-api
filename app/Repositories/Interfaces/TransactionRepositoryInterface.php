<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface TransactionRepositoryInterface
{
    /**
     * @param int $userId
     * @return float
     */
    public function getUserBalance(int $userId): float;

    /**
     * @param array $filters
     * @return Collection
     */
    public function getAllTransactions(array $filters): Collection;

    /**
     * @param int $transactionId
     * @return mixed
     */
    public function getTransactionById(int $transactionId): mixed;

    /**
     * @param array $data
     * @return mixed
     */
    public function createNewTransaction(array $data): mixed;

    /**
     * @param int $transactionId
     * @return void
     */
    public function deleteTransactionById(int $transactionId): void;

    /**
     * @param int $userId
     * @param string $startDate
     * @param string $endDate
     * @param string $type
     * @return float
     */
    public function getTransactionsSummaryByPeriodAndType(int $userId, string $startDate, string $endDate, string $type): float;

    /**
     * @param int $userId
     * @param string $startDate
     * @param string $endDate
     * @return float
     */
    public function getTransactionsSummaryByPeriod(int $userId, string $startDate, string $endDate): float;

}
