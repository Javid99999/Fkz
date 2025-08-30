<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {

        $products = Product::with(['statements' => function ($query) {
            $query->with(['productStatement.secureCodes']);
        }])->get();

        dump($products);

        
        return Inertia::render('welcome');
    }
}
