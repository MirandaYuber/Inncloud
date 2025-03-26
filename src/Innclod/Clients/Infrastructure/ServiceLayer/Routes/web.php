<?php

use Clients\Infrastructure\ServiceLayer\Controllers\ClientsController;
use Illuminate\Support\Facades\Route;

Route::prefix('clients')->group(function () {
    Route::middleware(['web'])->group(function () {
        Route::get(
            'index',
            [ClientsController::class, 'index']
        )->name('Clients.Index');
    });

    Route::middleware(['api'])->group(function () {
        Route::post(
            'getClientsByFilter',
            [ClientsController::class, 'getClientsByFilter']
        )->name('Clients.getClientsByFilter');
        Route::post(
            'createClient',
            [ClientsController::class, 'createClient']
        )->name('Clients.CreateClient');
        Route::post(
            'updateClient',
            [ClientsController::class, 'updateClient']
        )->name('Clients.UpdateClient');
        Route::post(
            'deleteClient',
            [ClientsController::class, 'deleteClient']
        )->name('Clients.DeleteClient');
    });
});
