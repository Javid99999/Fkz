<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductShowResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categoryId = $request->input('category_id');

        $query = Product::with(['media', 'country', 'category', 'productPropertyValues' => function($q) {
        $q->leftJoin('units', 'units.id', '=', 'product_property_values.unit_id')
          ->select(
                'properties.*',
                'product_property_values.value as pivot_value',
                'product_property_values.numeric as pivot_numeric',
                'product_property_values.value_parse_type as pivot_value_parse_type',
                'product_property_values.unit_id as pivot_unit_id',
                'units.id as unit_id',
                'units.unit as unit_name' // burada units.unit kullanıyoruz
            );
        },]);

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        $products = ProductShowResource::collection($query->paginate(3));

        $categories = Category::with(['children' => fn($q) => $q->withCount('products')])
            ->whereNull('parent_id')
            ->get();




        return Inertia::render('route/Product',[
                'products' => $products,
                'category' => $categories,
                'selectedCategory' => $categoryId
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($product)
    {

        $query = Product::with(['media', 'country', 'category', 'productClassification', 'productPropertyValues' => function($q) {
        $q->leftJoin('units', 'units.id', '=', 'product_property_values.unit_id')
          ->select(
                'properties.*',
                'product_property_values.value as pivot_value',
                'product_property_values.numeric as pivot_numeric',
                'product_property_values.value_parse_type as pivot_value_parse_type',
                'product_property_values.unit_id as pivot_unit_id',
                'units.id as unit_id',
                'units.unit as unit_name' // burada units.unit kullanıyoruz
            );
        },])->findOrFail($product);


        $products = new ProductResource($query);

        
        return Inertia::render('route/ProductDetails', ['product' => $products]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
