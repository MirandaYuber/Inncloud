<?php

use Illuminate\Support\Facades\Route;
use Innclod\Orders\Infrastructure\ServiceLayer\Controllers\OrdersController;

Route::prefix('orders')->group(function () {
    Route::middleware(['web'])->group(function () {
        Route::get(
            'index',
            [OrdersController::class, 'index']
        )->name('Orders.Index');
    });

    Route::middleware(['api'])->group(function () {
        Route::post(
            'createOrder',
            [OrdersController::class, 'createOrder']
        )->name('Orders.CreateOrder');
        Route::post(
            'getOrdersByClientId',
            [OrdersController::class, 'getOrdersByClientId']
        )->name('Orders.GetOrdersByClientId');
        Route::post(
            'getOrderDetailByOrderId',
            [OrdersController::class, 'getOrderDetailByOrderId']
        )->name('Orders.GetOrderDetailByOrderId');
    });
});
