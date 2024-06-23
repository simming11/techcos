<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Routes for users API
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index']); // Get all users
        Route::post('/', [UserController::class, 'store']); // Create a new user
        Route::get('/{id}', [UserController::class, 'show']); // Get a single user
        Route::put('/{id}', [UserController::class, 'update']); // Update a user
        Route::delete('/{id}', [UserController::class, 'destroy']); // Delete a user
    });
});
