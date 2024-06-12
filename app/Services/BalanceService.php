<?php

namespace App\Services;


use App\Repositories\Interfaces\TransactionRepositoryInterface;

class BalanceService
{
    public function __construct(
        protected TransactionRepositoryInterface $transactionRepository,
        protected CurrencyConversionService $currencyConversionService
    ) {
    }

    /**
     * @param int $userId
     * @param string $currency
     * @return float
     */
    public function getUserBalanceInCurrency(int $userId, string $currency): float
    {
        $balance = $this->transactionRepository->getUserBalance($userId);

        return $this->currencyConversionService->convert($balance, $currency);
    }
}
