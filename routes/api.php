<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\OrderController;
use Illuminate\Support\Facades\Route;

// Public Authentication Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected Routes (require authentication)
Route::middleware('auth:sanctum')->group(function () {
    
    // Product Routes
    Route::apiResource('products', ProductController::class);
    
    // Category Routes  
    Route::apiResource('categories', CategoryController::class);
    
    // Order Routes
    Route::apiResource('orders', OrderController::class);
    
    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);
});