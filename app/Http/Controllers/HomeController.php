<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\Statement;
use DB;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {


        $products = Product::with(['productStatements.statement', 'productStatements.securecodes','media', 'productPropertyValues' => function($q) {
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
    },])
            ->get();
        
        
        

        
        $products = ProductResource::collection($products);


        
        
        return Inertia::render('welcome', ['products' => $products]);
    }
}


















// 1️⃣ Products + Statements
        // $products = DB::table('products')
        //     ->join('product_statements', 'products.id', '=', 'product_statements.product_id')
        //     ->join('statements', 'product_statements.statement_id', '=', 'statements.id')
        //     ->select(
        //         'products.id as product_id',
        //         'products.name as product_name',
        //         'products.cas_number as product_cas_number',
        //         'products.description as product_description',
        //         'products.packaging as product_packaging',
        //         'statements.id as statement_id',
        //         'statements.name as statement_name',
        //         'product_statements.id as pivot_id'
        //     )
        //     ->get();

        // // Securecodes
        // $securecodes = DB::table('securecodes')->get()->groupBy('product_statement_id');

        // // Nested yapı
        // $products = $products->groupBy('product_id')
        //     ->map(fn($items) => [
        //         'id' => $items->first()->product_id,
        //         'name' => json_decode($items->first()->product_name, true),
        //         'cas_number' => $items->first()->product_cas_number,
        //         'description' => json_decode($items->first()->product_description, true),
        //         'packaging' => json_decode($items->first()->product_packaging, true),
        //         'statements' => $items->sortBy('statement_id') // statements sırası
        //             ->map(fn($item) => [
        //                 'id' => $item->statement_id,
        //                 'name' => $item->statement_name,
        //                 'securecodes' => isset($securecodes[$item->pivot_id])
        //                     ? $securecodes[$item->pivot_id]->sortBy('id')->map(fn($sc) => [
        //                         'id' => $sc->id,
        //                         'code' => $sc->code,
        //                         'description' => json_decode($sc->description, true)
        //                     ])->values()->toArray()
        //                     : []
        //             ])->values()
        //     ])
        //     ->sortBy('id') // ürünleri ID sırasına göre
        //     ->values();





// $products = DB::table('products')
        // ->leftJoin('product_statements', 'products.id', '=', 'product_statements.product_id')
        // ->leftJoin('statements', 'product_statements.statement_id', '=', 'statements.id')
        // ->select(
        //     'products.id as product_id',
        //     'products.name as product_name',
        //     DB::raw('GROUP_CONCAT(statements.name) as statements')
        // )
        // ->groupBy('products.id', 'products.name')
        // ->get()
        // ->map(function($p){
        //     $p->statements = explode(',', $p->statements);
        //     return $p;
        // });
































// $productId = 1; // Örnek product ID

// $rows = DB::table('product_statements')
//     ->join('statements', 'statements.id', '=', 'product_statements.statement_id')
//     ->leftJoin('securecodes', 'securecodes.product_statement_id', '=', 'product_statements.id')
//     ->where('product_statements.product_id', $productId)
//     ->select(
//         'product_statements.id as ps_id',
//         'statements.id as statement_id',
//         'statements.name as statement_name',
//         'securecodes.id as securecode_id',
//         'securecodes.code as securecode'
//     )
//     ->get();