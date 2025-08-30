<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasTranslations;


    protected $fillable = [
        'name',
        'cas_number',
        'description',
        'packaging',
        'country_id',
        'category_id'
    ];


    protected $translatable = ['name','description','packaging'];


    protected $casts = [
        'name' => 'array',
        'description' => 'array',
        'packaging' => 'array',
    ];










    public function statements()
    {
        return $this->belongsToMany(
            Statement::class, 
            'product_statements', 
            'product_id', 
            'statements_id')
                ->withPivot('id'); // product_statement tablosundaki id-yi cekmek ucun
    }





    public function productClassifications()
    {
        return $this->belongsToMany(Classification::class,'product_classifications')
            ->withPivot('risk_level_id');
    }



    public function getNameEnAttribute()
    {
        return $this->name['en'] ?? null;
    }

    public function getNameAzAttribute()
    {
        return $this->name['az'] ?? null;
    }











    
    public function getNameTrAttribute()
    {
        return $this->name['tr'] ?? null;
    }

    public function getNameRuAttribute()
    {
        return $this->name['ru'] ?? null;
    }


    public function getNameChAttribute()
    {
        return $this->name['zhcn'] ?? null;
    }


}
