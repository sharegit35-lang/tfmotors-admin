<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\CarRequestController;

// 1. Route សម្រាប់ Admin / Manager Login (ទទួលយក email និង password ពី Flutter App)
Route::post('/login', [AdminAuthController::class, 'login']);

// 2. Route ផ្សេងៗដែលត្រូវការ Token (Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/requests', [CarRequestController::class, 'index']);
    Route::post('/requests', [CarRequestController::class, 'store']);
    Route::put('/requests/{id}/status', [CarRequestController::class, 'updateStatus']);
    
});