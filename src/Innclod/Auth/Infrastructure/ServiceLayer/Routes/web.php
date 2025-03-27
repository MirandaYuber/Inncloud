<?php

use Illuminate\Support\Facades\Route;
use Innclod\Auth\Infrastructure\ServiceLayer\Controllers\AuthController;

Route::middleware(['web'])->group(function () {

    Route::post('auth', [AuthController::class, 'auth'])
        ->name('auth');

    Route::post('logout', [AuthController::class, 'logout'])
        ->middleware(['auth'])
        ->name('logout');
});
