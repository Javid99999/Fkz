<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class DeliveryMethod extends Model
{
    use HasTranslations;


    protected $translatable = ['description'];

    protected $fillable = [
        'code',
        'expansion',
        'description',
        'sort_order'
    ];

    protected $casts = [
        'description' => 'array'
    ];


    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_delivery_methods')
            ->withPivot([
                'additional_cost',
                'currency',
                'estimated_days_min',
                'estimated_days_max',
                'custom_notes',
                'custom_attributes',
            ]);
    }

    public function responsibilities()
    {
        return $this->hasMany(DeliveryResponsibility::class, 'delivery_method_id');
    }
}
