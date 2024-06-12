<?php

return [
    'default' => env('CURRENCY_EXCHANGE_DRIVER', 'average'),

    'drivers' => [
        'xml' => [
            'class' => App\Services\CurrencyExchange\XmlCurrencyExchangeDriver::class,
        ],
        'json' => [
            'class' => App\Services\CurrencyExchange\JsonCurrencyExchangeDriver::class,
        ],
        'csv' => [
            'class' => App\Services\CurrencyExchange\CsvCurrencyExchangeDriver::class,
        ],
        'average' => [
            'class' => App\Services\CurrencyExchange\AverageCurrencyExchangeDriver::class,
            'dependencies' => [
                'xml',
                'json',
                'csv',
            ],
        ],
    ],
];
