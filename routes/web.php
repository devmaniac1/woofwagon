<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Livewire\Admin\ManageProducts;
use App\Http\Controllers\Admin\ViewOrdersController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;//use for sanctum


Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

define('PROFILE_ROUTE', '/profile');

Route::middleware('auth')->group(function () {
    Route::get(PROFILE_ROUTE, [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch(PROFILE_ROUTE, [ProfileController::class, 'update'])->name('profile.update');
    Route::delete(PROFILE_ROUTE, [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//user routes
Route::middleware(['auth', 'userMiddleware'])->group(function (){
Route::get('dashboard',[UserController::class,'index'])->name('dashboard');
});

//admin routes
Route::middleware(['auth', 'adminMiddleware'])->group(function (){
Route::get('/admin/dashboard',[AdminController::class,'index'])->name('admin.dashboard');
});

Route::get('/shop', [ShopController::class, 'index'])->name('shop');

Route::get('/services', function () {
    return view('services');
})->name('services');

Route::middleware(['auth', 'adminMiddleware'])->group(function () {
    Route::get('/admin/manageProducts', \App\Http\Livewire\Admin\ManageProducts::class)->name('admin.manageProducts');
});

//cart route
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'addToCart'])
    ->middleware('auth:sanctum')
    ->name('cart.add');

Route::patch('/cart/update/{id}', [CartController::class, 'updateCart'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

// Route for Checkout page
Route::get('/checkOut', [CheckoutController::class, 'index'])->name('checkOut');
Route::post('/apply-discount', [CheckoutController::class, 'applyDiscount'])->name('applyDiscount');
Route::post('/checkout-process', [CheckoutController::class, 'checkoutProcess'])->name('checkoutProcess');
Route::post('checkout/create-order', [OrderController::class, 'createOrder'])->name('order.create');


Route::middleware(['auth', 'adminMiddleware'])->group(function () {
    Route::get('/admin/viewOrders', [OrderController::class, 'viewOrders'])->name('adminViewOrders');
});

Route::patch('/admin/order/update-status/{id}', [OrderController::class, 'updateOrderStatus'])->name('admin.order.updateStatus');

Route::get('/viewPastOrders', [OrderController::class, 'viewPastOrders'])->name('viewPastOrders');

