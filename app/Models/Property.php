<?php

namespace App\Models;

use App\Enum\PropertyType;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Property extends Model
{
    use HasTranslations;


    public $translatable = ['name'];

    protected $fillable = ['name', 'property_type'];



    protected $casts = [
        'name' => 'array',
        'property_type' => PropertyType::class,
    ];


    public function products()
    {
        return $this->belongsToMany(
                Product::class, 
                'product_property_values', 
                'property_id', 
                'product_id'
                )
                ->withPivot('value', 'numeric', 'value_parse_type', 'unit_id');
    }

    

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_properties');
    }



    // Getterler
    public function getNameEnAttribute()
    {
        return $this->getTranslation('name', 'en') ?? 'bos';
    }


    public function getNameTrAttribute()
    {
        return $this->getTranslation('name', 'tr') ?? 'bos';
    }
    //---------------------------------


}
