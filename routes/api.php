<?php

use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionSummaryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    Route::apiResources([
        'transactions', TransactionController::class,
        'transaction-summary', TransactionSummaryController::class,
    ]);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
