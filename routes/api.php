<?php
use App\Http\Controllers\Api\ProductController;


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/products', [ProductController::class, 'index']); // List all products
    Route::post('/products', [ProductController::class, 'addProduct']); // Add a product

    $productRoute = '/products/{id}';
    Route::get($productRoute, [ProductController::class, 'show']); // Get a single product
    Route::put($productRoute, [ProductController::class, 'update']); // Update a product
    Route::delete($productRoute, [ProductController::class, 'deleteProduct']); // Delete a product
});
