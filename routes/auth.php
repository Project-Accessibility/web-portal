<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('login', [
        AuthenticatedSessionController::class,
        'create',
    ])->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::controller(ForgotPasswordController::class)
        ->prefix('/password')
        ->group(function () {
            Route::get('/reset', 'showLinkRequestForm')->name(
                'password.request',
            );
            Route::post('/email', 'sendResetLinkEmail')->name('password.email');
        });
    Route::controller(ResetPasswordController::class)
        ->prefix('/password')
        ->group(function () {
            Route::get('/reset-password/{token}', 'showResetForm')->name(
                'password.reset',
            );
            Route::post('/reset', 'reset')->name('password.update');
        });
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [
        AuthenticatedSessionController::class,
        'destroy',
    ])->name('logout');
});
