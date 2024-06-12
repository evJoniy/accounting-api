<?php

use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    Route::apiResource('transactions', TransactionController::class);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
