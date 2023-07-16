<?php

use App\Http\Controllers\Products\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/products', [ProductController::class, 'listAllProduct']);

Route::middleware(['jwt.verify'])->group(function () {
    Route::prefix('/auth')->group(function () {
        Route::post('/product', [ProductController::class, 'createProduct']);
        Route::patch('/product/{id}', [ProductController::class, 'updateProduct']);
        Route::delete('/product/{id}', [ProductController::class, 'deleteProduct']);
    });
});
