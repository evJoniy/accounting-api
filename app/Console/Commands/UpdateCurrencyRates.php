<?php

namespace App\Console\Commands;

use App\Facades\CurrencyExchange;
use Illuminate\Console\Command;

class UpdateCurrencyRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:update-rates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update cached currency rates';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $drivers = ['xml', 'json', 'csv'];
        $currencies = ['USD', 'EUR'];

        foreach ($drivers as $driver) {
            $exchange = CurrencyExchange::make($driver);
            foreach ($currencies as $currency) {
                $exchange->getRate($currency);
            }
        }

        $this->info('Currency rates updated.');
    }
}
