<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    $products = Product::all();
    return view('welcome', compact('products'));
})->name('home');

Route::get('/product/{product}', function (Product $product) {
    return view('product-detail', compact('product'));
})->name('product.show');

Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');

    Route::get('/admin/orders', [AdminController::class, 'index'])->name('admin.orders');
    Route::post('/admin/orders/{order}/status', [AdminController::class, 'updateStatus'])->name('admin.orders.status');

    Route::post('/orders/{order}/cancel', [DashboardController::class, 'cancelOrder'])->name('orders.cancel');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';