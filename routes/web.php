<?php

use App\Http\Controllers\BuahController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PesanController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'index']);

//dashboard and products route
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::post('/product/add', [ProductController::class, 'store'])->name('product.store');
    Route::get('/products/{product:name}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/products/{product:name}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/{name}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::get('products/search', [ProductController::class, 'search'])->name('product.search');
});

//orders
Route::middleware('auth')->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    Route::post('/orders/add', [OrderController::class, 'store'])->name('order.store');
    Route::get('/orders/{order:uuid}/edit', [OrderController::class, 'edit'])->name('order.edit');
    Route::put('/orders/{order:uuid}', [OrderController::class, 'update'])->name('order.update');
    Route::get('/orders/{uuid}', [OrderController::class, 'delete'])->name('order.delete');
    Route::get('/orders/{uuid}/details', [OrderController::class, 'details'])->name('order.details');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//customer
Route::middleware('auth')->group(function () {
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers');
    Route::post('/customers/create', [CustomerController::class, 'store'])->name('customer.create');
    Route::get('/customers/{customer:uuid}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::put('/customers/{customer:uuid}', [CustomerController::class, 'update'])->name('customer.update');
    Route::get('/customer/{uuid}', [CustomerController::class, 'delete'])->name('customer.delete');
});

Route::post('/order', [PesanController::class, 'placeOrder'])->name('order.place');

require __DIR__ . '/auth.php';
