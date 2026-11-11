<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    $products = Product::all();
    return view('welcome', compact('products'));
})->name('home');

Route::get('/product/{product}', function (Product $product) {
    return view('product-detail', compact('product'));
})->name('product.show');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');

// Admin Routes
Route::get('/admin/orders', [AdminController::class, 'index'])->name('admin.orders');
Route::post('/admin/orders/{order}/status', [AdminController::class, 'updateStatus'])->name('admin.orders.status');