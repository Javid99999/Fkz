<?php

namespace App\Models;

use App\Enum\AvailabilityType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Spatie\Translatable\HasTranslations;

class ProductDeliveryMethod extends Pivot
{
    use HasTranslations;


    protected $translatable = [
        'custom_notes',
        'custom_attributes',
        'location_name',
        'specific_details'
    ];


    protected $fillable = [
        'product_id',
        'delivery_method_id',
        'additional_cost',
        'currency',
        'estimated_days_min',
        'estimated_days_max',
        'custom_notes',
        'custom_attributes',
        'location_name',
        'specific_details',
        'availability_type'
    ];


    protected $casts = [
        'custom_notes' => 'array',
        'custom_attributes' => 'array',
        'location_name' => 'array',
        'specific_details' => 'array',
        'availability_type' => AvailabilityType::class
    ];


    public function deliveryMethod()
    {
        return $this->belongsTo(DeliveryMethod::class);
    }
    

    

}
