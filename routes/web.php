<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [HomeController::class, 'home'])->name('home');


Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::get('/about', [ProductController::class, 'about'])->name('products.about');

Route::get('/contact', [ProductController::class, 'contact'])->name('company.contact');

Route::get('/detail/products/{product}', [ProductController::class, 'show'])->name('products.show');


Route::post('/set-locale', function (Request $request) {
    $locale = $request->input('locale', 'en');
    Session::put('locale', $locale);
    App::setLocale($locale);
})->name('set.locale');