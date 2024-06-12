<?php

namespace App\Services\CurrencyExchange;

use App\Services\CurrencyExchange\Interfaces\CurrencyExchangeDriverInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class JsonCurrencyExchangeDriver implements CurrencyExchangeDriverInterface
{
    /** @inheritdoc */
    public function getRate(string $currency): float
    {
        return Cache::remember("currency-rate-json-{$currency}", 300, function () use ($currency) {
            $content = Storage::get('currency-rates.json');
            $json = json_decode($content, true);
            return (float) $json['rates'][$currency];
        });
    }
}
