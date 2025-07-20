<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Home / Product Catalog
Route::get('/', [ProductController::class, 'index'])
     ->name('home');

// Cart (session-based, available to everyone)
Route::get('cart', [CartController::class, 'index'])
     ->name('cart.index');
Route::post('cart/add/{product}', [CartController::class, 'add'])
     ->name('cart.add');
Route::patch('cart/update/{product}', [CartController::class, 'update'])
     ->name('cart.update');
Route::delete('cart/remove/{product}', [CartController::class, 'remove'])
     ->name('cart.remove');

// Authentication (login, register, etc.)
Auth::routes();


/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Dashboard (after login)
    Route::get('/home', [HomeController::class, 'index'])
         ->name('dashboard');

    // Checkout
    Route::get('checkout', [OrderController::class, 'create'])
         ->name('checkout');
    Route::post('checkout', [OrderController::class, 'store'])
         ->name('checkout.store');

    // Admin: manage categories & products
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
});