<?php

namespace App\Models;

use App\Enum\AvailabilityType;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class DeliveryAvailability extends Model
{
    use HasTranslations;


    protected $translatable = [
        'location_name',
        'specific_details'
    ];



    protected $fillable = [
        'delivery_method_id',
        'availability_type',
        'location_code',
        'location_name',
        'specific_details'
    ];


    protected $casts = [
        'location_name' => 'array',
        'specific_details' => 'array',
        'availability_type' => AvailabilityType::class
    ];

    
    public function availabilities()
    {
        return $this->hasMany(DeliveryAvailability::class);
    }
}
