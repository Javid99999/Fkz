<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class DeliveryInfo extends Model
{
    use HasTranslations;

    protected $fillable = [
        'delivery',
        'loading'
    ];

    protected $translatable = [
        'delivery',
        'loading'
    ];

    protected $casts = [
        'delivery' => 'array',
        'loading' => 'array'
    ];

    public function deliverinfo()
    {
        return $this->belongsTo(Product::class);
    }


    public function getDeliveryTrAttribute()
    {
        return $this->getTranslation('delivery', 'tr', false) 
            ?? $this->delivery; // fallback otomatik alır
    }

    public function getLoadingTrAttribute()
    {
        return $this->getTranslation('delivery', 'tr', false) 
            ?? $this->delivery; // fallback otomatik alır
    }

}
