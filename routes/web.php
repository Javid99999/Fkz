<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');


Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::get('/detail/{product}/product', [ProductController::class, 'show'])->name('products.show');