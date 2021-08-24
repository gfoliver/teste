<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

Route::prefix('user')->group(function() {
    Route::post('/', [UserController::class, 'register'])->name('api.user.register');
});

Route::prefix('auth')->group(function() {
    Route::post('login', [AuthController::class, 'login'])->name('api.auth.login');
});

Route::middleware('jwt.verify')->group(function() {

    Route::prefix('user')->group(function() {

        Route::post('update', [UserController::class, 'update'])->name('api.user.update');

        Route::get('info', [UserController::class, 'info'])->name('api.user.info');

        Route::delete('/', [UserController::class, 'delete'])->name('api.user.delete');
    });

    Route::prefix('auth')->group(function() {
        Route::post('logout', [AuthController::class, 'logout'])->name('api.auth.logout');

        Route::post('refresh', [AuthController::class, 'refresh'])->name('api.auth.refresh');
    });
});
