<?php

namespace App\Services\CurrencyExchange;

use App\Services\CurrencyExchange\Interfaces\CurrencyExchangeDriverInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class CsvCurrencyExchangeDriver implements CurrencyExchangeDriverInterface
{
    /** @inheritdoc */
    public function getRate(string $currency): float
    {
        return Cache::remember("currency-rate-csv-{$currency}", 300, function () use ($currency) {
            $content = Storage::get('currency-rates.csv');
            $lines = explode("\n", trim($content));
            foreach ($lines as $line) {
                list($curr, $rate) = str_getcsv($line);
                if ($curr === $currency) {
                    return (float) $rate;
                }
            }
            throw new \Exception("Currency not found");
        });
    }
}
