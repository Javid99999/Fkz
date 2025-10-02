<?php

namespace App\Http\Controllers;

use App\Http\Resources\DocumentsResource;
use App\Http\Resources\ProductDeliveryResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductShippingResource;
use App\Http\Resources\ProductShowResource;
use App\Http\Resources\PoductDelMethResource;
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
        $search = $request->input('search');

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


        // if ($search) {
        //     $query->where(function ($q) use ($search, $request) {
        //         $field = $request->input('search_field', 'name');
        //         if ($field === 'name') {
        //             $q->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%']);
        //         } elseif ($field === 'cas_number') {
        //             $q->where('cas_number', 'like', "%{$search}%");
        //         }
        //     });
        // }


        // if ($search) {
        //     $searchLower = strtolower(trim($search));
        //     $currentLang = app()->getLocale(); // veya request()->get('lang', 'en')
            
        //     $query->where(function ($q) use ($searchLower, $currentLang) {
        //         // Sadece o dildeki name'de ara
        //         $q->whereRaw("LOWER(JSON_UNQUOTE(JSON_EXTRACT(name, '$.{$currentLang}'))) LIKE ?", ['%' . $searchLower . '%']);
                
        //         // CAS numarasında ara (opsiyonel)
        //         $q->orWhere('cas_number', 'like', '%' . $searchLower . '%');
        //     });
        // }


        if ($search) {
            $query->where(function ($q) use ($search, $request) {
                $field = $request->input('search_field', 'name');
                $lang = $request->input('lang', 'en'); // aktif dili al

                $q->whereRaw("LOWER(JSON_UNQUOTE(name->'$.{$lang}')) LIKE ?", ['%' . strtolower($search) . '%'])
                    ->orWhereRaw("CAST(cas_number AS CHAR) LIKE ?", ["%{$search}%"]);
                
            });
        }
        

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        $pagino = $query->paginate(6);

        $products = ProductShowResource::collection($pagino);

        $categories = Category::with(['children' => fn($q) => $q->withCount('products')])
            ->whereNull('parent_id')
            ->get();




        return Inertia::render('route/Product',[
                'products' => $products,
                'category' => $categories,
                'selectedCategory' => $categoryId,
                'searchTerm' => $search,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function contact()
    {
        

        return Inertia::render('route/Contact');
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

        $tab = request()->query('tab');

        if ($tab) {
            $query = Product::with([
                'category',
                'country',
                'productStatements',
                'productPictogram',
                'productClassification',
                'productPropertyValuess.property',
                'productPropertyValuess.unit'
            ])->findOrFail($product);
            
            $products = new ProductResource($query);
        } else {
            // İlk yüklemede media dahil tam veri
            $query = Product::with([
                // 'media',
                'category',
                'country',
                'productStatements',
                'productPictogram',
                'productClassification',
                'productPropertyValuess.property',
                'productPropertyValuess.unit'
            ])->findOrFail($product);
            
            $products = new ProductResource($query);
        }


        $delivery = [];
        $shipping = [];
        $documents = [];
        if ($tab === 'delivery') {
            $delivery = Product::with('deliveryMethods.responsibilities','productCountryShipment', 'productTerms')
                ->findOrFail($product);
            $delivery = new ProductDeliveryResource($delivery);
        };

       if ($tab === 'shipping'){
            $shipping = Product::with('deliverInfo','productPackaging', 'requireDoc')->findOrFail($product);

            $shipping->country = $query->country;
            $shipping = new ProductShippingResource($shipping);

       }

       if(($tab === 'documents'))
        {
            $documents = Product::with('media')->findOrFail($product);

            $documents = new DocumentsResource($documents);
        }
        
        
        return Inertia::render('route/ProductDetails', [
            'product' => $products,
            'delivery' => $delivery,
            'shipping' => $shipping,
            'documents' => $documents
        ]);
    }



    public function about()
    {

        return Inertia::render('route/About');
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








// $query = Product::with(['media', 'category','country', 'productStatements', 'productPictogram', 'productClassification', 'productPropertyValues' => function($q) {
        // $q->leftJoin('units', 'units.id', '=', 'product_property_values.unit_id')
        //   ->select(
        //         'properties.*',
        //         'product_property_values.value as pivot_value',
        //         'product_property_values.numeric as pivot_numeric',
        //         'product_property_values.value_parse_type as pivot_value_parse_type',
        //         'product_property_values.unit_id as pivot_unit_id',
        //         'units.id as unit_id',
        //         'units.unit as unit_name' // burada units.unit kullanıyoruz
        //     );
        // },])->findOrFail($product);


        // public function showtabs(Product $product)
    // {
    //     $product->load([
    //         'media',
    //         'category',
    //         'country',
    //         'productPropertyValues' => function($q) {
    //             $q->leftJoin('units', 'units.id', '=', 'product_property_values.unit_id')
    //             ->select(
    //                 'properties.*',
    //                 'product_property_values.value as pivot_value',
    //                 'product_property_values.numeric as pivot_numeric',
    //                 'product_property_values.value_parse_type as pivot_value_parse_type',
    //                 'product_property_values.unit_id as pivot_unit_id',
    //                 'units.id as unit_id',
    //                 'units.unit as unit_name'
    //             );
    //         },
    //     ]);

    //     return Inertia::render('route/ProductDetails', [
    //         'product' => new ProductResource($product),
    //     ]);
    // }






    // $query = Product::with([
        //     'media',
        //     'category',
        //     'country',
        //     'productStatements',
        //     'productPictogram',
        //     'productClassification',
        //     'productPropertyValuess.property',
        //     'productPropertyValuess.unit'
        //     ])->findOrFail($product);


        // $products = new ProductResource($query);
        // Eğer tab varsa, media olmadan minimal product verisi