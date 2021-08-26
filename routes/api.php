<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AddressController;

Route::prefix('user')->group(function() {
    Route::post('/', [UserController::class, 'register'])->name('api.user.register');
});

Route::prefix('auth')->group(function() {
    Route::post('login', [AuthController::class, 'login'])->name('api.auth.login');
});

Route::middleware('jwt.verify')->group(function() {

    Route::prefix('user')->group(function() {

        Route::put('/', [UserController::class, 'update'])->name('api.user.update');

        Route::get('info', [UserController::class, 'info'])->name('api.user.info');

        Route::delete('/', [UserController::class, 'delete'])->name('api.user.delete');
    });

    Route::prefix('auth')->group(function() {
        Route::post('logout', [AuthController::class, 'logout'])->name('api.auth.logout');

        Route::post('refresh', [AuthController::class, 'refresh'])->name('api.auth.refresh');
    });

    Route::prefix('address')->group(function() {

        Route::post('/', [AddressController::class, 'create'])->name('api.address.create');

        Route::put('/{id}', [AddressController::class, 'update'])->name('api.address.update');

        Route::get('/{id}', [AddressController::class, 'info'])->name('api.address.info');

        Route::delete('/{id}', [AddressController::class, 'delete'])->name('api.address.delete');
    });
});
