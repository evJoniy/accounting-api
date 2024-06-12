<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TransactionFilter
{
    public function __construct(
        protected Request $request
    ) {
    }

    public function getAll(Builder $query): Builder
    {
        $type = $this->request->input('type');
        $amount = $this->request->input('amount');
        $date = $this->request->input('date');

        $query->when($type, fn($query) => match ($type) {
            'income' => $query->where('amount', '>', 0),
            'expense' => $query->where('amount', '<', 0),
            default => $query,
        });

        $query->when($amount, fn($query, $amount) => $query->where('amount', $amount));

        $query->when($date, fn($query, $date) => $query->whereDate('created_at', $date));

        return $query;
    }
}
