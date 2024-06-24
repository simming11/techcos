<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GrantController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::post('/register', [UserController::class, 'store']); // Create a new user

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index']); // Get all users
        Route::get('/{id}', [UserController::class, 'show']); // Get a single user
        Route::put('/{id}', [UserController::class, 'update']); // Update a user
        Route::delete('/{id}', [UserController::class, 'destroy']); // Delete a user
    });
    
    Route::prefix('grants')->group(function () {
        Route::get('/', [GrantController::class, 'index']); // Get all grants
        Route::post('/', [GrantController::class, 'store']); // Create a new grant
        Route::get('/{id}', [GrantController::class, 'show']); // Get a single grant
        Route::put('/{id}', [GrantController::class, 'update']); // Update a grant
        Route::delete('/{id}', [GrantController::class, 'destroy']); // Delete a grant
    });
});
