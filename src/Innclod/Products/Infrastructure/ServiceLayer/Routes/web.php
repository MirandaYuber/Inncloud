<?php

use Illuminate\Support\Facades\Route;
use Innclod\Products\Infrastructure\ServiceLayer\Controllers\ProductsController;

Route::prefix('products')->group(function () {
    Route::middleware(['web'])->group(function () {
        Route::get('index', [ProductsController::class, 'index'])->name('Products.Index');
    });

    Route::middleware(['api'])->group(function () {
         Route::post(
            'getProductsByClientId',
            [ProductsController::class, 'getProductsByClientId']
        )->name('Products.GetProductsByClientId');
         Route::post(
            'getProductsIdByClientId',
            [ProductsController::class, 'getProductsIdByClientId']
        )->name('Products.GetProductsIdByClientId');
         Route::post(
            'getProductsByName',
            [ProductsController::class, 'getProductsByName']
        )->name('Products.GetProductsByName');
         Route::post(
            'createProduct',
            [ProductsController::class, 'createProduct']
        )->name('Products.CreateProduct');
         Route::post(
            'updateProduct',
            [ProductsController::class, 'updateProduct']
        )->name('Products.UpdateProduct');
         Route::post(
            'deleteProduct',
            [ProductsController::class, 'deleteProduct']
        )->name('Products.DeleteProduct');
    });

});
