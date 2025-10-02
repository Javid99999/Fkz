<?php

namespace App\Models;

use App\Enum\ResponsibleType;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class DeliveryResponsibility extends Model
{
    use HasTranslations;


    protected $translatable = ['responsibility_value'];

    
    protected $fillable = [
        'delivery_method_id',
        'responsibility_type',
        'responsibility_value',
        'sort_order'
    ];

    protected $casts = [
        'responsibility_value',
        'responsibility_type' => ResponsibleType::class
    ];


    public function deliveryMethod()
    {
        return $this->belongsTo(DeliveryMethod::class);
    }

}
