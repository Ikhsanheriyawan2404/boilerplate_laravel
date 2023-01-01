<?php

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\UserController;
use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\TransactionController;

Route::fallback(function () {
    return response()->json([
        'code' => Response::HTTP_NOT_FOUND,
        'status' => Response::$statusTexts[404],
        'message' => 'Not Found. If error persists, contact ikhsanheriyawan2404@gmail.com'
    ], 404);
});

Route::prefix('v1')->group(function () {
    // Authentication
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('users/{user}', [UserController::class, 'show']);
        Route::post('logout', [AuthController::class, 'logout']);

        Route::post('users/{userId}/disbursement', [TransactionController::class, 'processDisbursement']);
        Route::get('users/{userId}/history-transactions', [TransactionController::class, 'historyTransaction']);
    });
});
