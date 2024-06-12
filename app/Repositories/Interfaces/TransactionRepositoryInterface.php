<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface TransactionRepositoryInterface
{
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
}
