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






    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('detailfoto')
            ->useDisk('public');

        $this->addMediaCollection('vitrin')
            ->singleFile()
            ->useDisk('public');
    }









    public function productPropertyValuess()
    {
        return $this->hasMany(ProductPropertyValue::class);
    }


    // Dur hele
    public function productPropertyValues()
    {
        return $this->belongsToMany(
            Property::class,
            'product_property_values',
            'product_id',
            'property_id',
        )
        ->using(ProductPropertyValue::class)
        ->withPivot('value', 'numeric', 'value_parse_type','unit_id');
    }


    public function statements()
    {
        return $this->belongsToMany(
            Statement::class, 
            'product_statements', 
            'product_id', 
            'statements_id')
                ->withPivot('id'); // product_statement tablosundaki id-yi cekmek ucun
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
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
