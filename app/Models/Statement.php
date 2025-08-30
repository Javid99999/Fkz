<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Statement extends Model
{

    protected $fillable = ['name'];



    public function productStatements()
    {
        return $this->hasMany(ProductStatement::class);
    }


    public function products()
    {
        return $this->belongsToMany(
            Product::class, 
            'product_statement', 
            'statement_id',
             'product_id')
                ->withPivot('id'); // product_statement tablosundaki id-yi cekmek ucun
    }
}
