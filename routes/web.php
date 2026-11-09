<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;

Route::get('/', function () {
    $products = Product::all();
    return view('welcome', compact('products'));
})->name('home');

Route::get('/product/{product}', function (Product $product) {
    return view('product-detail', compact('product'));
})->name('product.show');